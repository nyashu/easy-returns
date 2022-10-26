<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Phpml\Classification\SVC;
use Phpml\Regression\LeastSquares;
use Phpml\SupportVectorMachine\Kernel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    const ADMIN = 1;
    const STORE = 2;
    const USER = 3;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'address',
        'is_verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'return_frequency',
        'user_return_likeliness',
        'total_store_return'
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            if ($user->role_id == User::STORE) {
                Store::where('user_id', $user->id)->delete();
                EasyReturn::where('store_id', $user->id)->delete();
            } elseif ($user->role_id == User::USER)
                EasyReturn::where('user_id', $user->id)->delete();
        });
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    public function returns(): HasMany
    {
        return $this->hasMany(EasyReturn::class);
    }

    public function storeRequests(): HasMany
    {
        return $this->hasMany(EasyReturn::class, 'store_id');
    }

    public function getReturnFrequencyAttribute()
    {
        if ($this->role_id == User::STORE) {
            $samples = [[0], [50], [200], [500], [1000], [2000], [2500], [3000], [3500]];
            // $targets = ['Never', 'Very Rarely', 'Rarely', 'Occasionally', 'Frequently', 'Very Frequently', 'Very Often', 'Usually', 'Always'];
            $targets = [1, 2, 3, 4, 5, 6, 7, 8, 9];

            $regression = new LeastSquares();
            $regression->train($samples, $targets);

            $return_count = $this->storeRequests()->count();
            $frequency = $regression->predict([$return_count]);

            if ($frequency >= 1 && $frequency < 2)
                return 'Never';
            elseif ($frequency >= 2 && $frequency < 3)
                return 'Very Rarely';
            elseif ($frequency >= 3 && $frequency < 4)
                return 'Rarely';
            elseif ($frequency >= 4 && $frequency < 5)
                return 'Occasionally';
            elseif ($frequency >= 5 && $frequency < 6)
                return 'Frequently';
            elseif ($frequency >= 6 && $frequency < 7)
                return 'Very Frequently';
            elseif ($frequency >= 7 && $frequency < 8)
                return 'Very Often';
            elseif ($frequency >= 8 && $frequency < 9)
                return 'Usually';
            elseif ($frequency >= 9)
                return 'Always';
        }
    }

    public function getTotalStoreReturnAttribute()
    {
        if ($this->role_id == User::STORE) {
            return EasyReturn::where('store_id', $this->id)->count();
        }
    }

    public function getUserReturnLikelinessAttribute()
    {
        if ($this->role_id == User::USER) {
            $samples = [[3], [7], [15]];
            $targets = ['1', '2', '3'];

            $regression = new LeastSquares();
            $regression->train($samples, $targets);

            $frequency = $regression->predict([$this->returns()->count()]);

            if ($frequency >= 1 && $frequency < 2)
                return 'Low';
            elseif ($frequency >= 2 && $frequency < 3)
                return 'Moderate';
            elseif ($frequency >= 3)
                return 'High';

            // $classifier = new SVC(
            //     Kernel::LINEAR, // $kernel
            //     1.0,            // $cost
            //     3,              // $degree
            //     null,           // $gamma
            //     0.0,            // $coef0
            //     0.001,          // $tolerance
            //     100,            // $cacheSize
            //     true,           // $shrinking
            //     true            // $probabilityEstimates, set to true
            // );


        }
    }
}
