<?php

namespace App\Http\Controllers;

use App\Models\User;
use Phpml\Regression\LeastSquares;

class PredictionController extends Controller
{
    public function predict(User $user)
    {
        return $user;
        if ($user->role_id != User::STORE)
            return back()->with('error', 'Only stores are allowed !!');

        $samples = [[0], [5], [10], [15], [20], [25], [30], [40], [50]];
        $targets = ['Never', 'Very Rarely', 'Rarely', 'Occasionally', 'Frequently', 'Very Frequently', 'Very Often', 'Usually', 'Always'];

        $regression = new LeastSquares();
        $regression->train($samples, $targets);
        // $regression->predict([])
    }
}
