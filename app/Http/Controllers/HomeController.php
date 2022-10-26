<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stores = User::where('role_id', User::STORE)->latest()->paginate(5);
        
        if (auth()->user()->role_id == User::STORE)
            $returns = Auth::user()->storeRequests()->latest()->paginate(5);
        return view('dashboard', compact('stores', isset($returns) ? 'returns' : []));
    }

    public function users()
    {
        $users = User::where('role_id', User::USER)->paginate(5);
        return view('users.index', compact('users'));
    }

    public function stores()
    {
    }
}
