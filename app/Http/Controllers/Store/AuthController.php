<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth-backend.register');
    }

    public function register(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'numeric', 'digits_between:5,20'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'website' => ['required', 'string', 'min:3', 'max:255'],
            'type' => ['required', 'string', 'in:electronics,furnitures,fashions'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated = $data->validated();
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated + [
            'role_id' => User::STORE,
            'is_verified' => false
        ]);

        $user->store()->create($validated);
        $user->addMedia(resource_path() . '/img/avatar.png')->preservingOriginal()->toMediaCollection('profile');

        return back()->with('success', 'Store information has been submited, Please take a moment until we review it');
    }

    public function loginForm()
    {
        return view('auth-backend.login');
    }

    public function login(Request $request)
    {
        $data = Validator::make($request->only(['email', 'password']), [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable']
        ]);

        $validated = $data->validated();

        $user = User::where('email', $validated['email'])->firstOrFail();

        if (!Hash::check($validated['password'], $user->password))
            return back()->with('error', 'Incorrect Password');

        if ($user->role_id == User::USER)
            return back()->with('error', 'Only store owner and admin are allowed to login');

        if (!($user->is_verified))
            return back()->with('error', 'Your account is in verification process');

        Auth::attempt($validated, $validated);

        return redirect()->route('home');
    }
}
