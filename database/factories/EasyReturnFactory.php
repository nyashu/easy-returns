<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EasyReturn>
 */
class EasyReturnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::where('role_id', User::USER)->get()->pluck('id')->toArray();
        $stores = User::where('role_id', User::STORE)->get()->pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($users),
            'store_id' => $this->faker->randomElement($stores),
            'description' => $this->faker->sentence(10),
            'price' => rand(111, 999),
            'status' => $this->faker->randomElement(['pending', 'verified', 'in progress', 'rejected']),
            'is_returned' => rand(0,1)
        ];
    }
}
