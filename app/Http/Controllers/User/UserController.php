<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('auth.update-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $data =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email' . $user->email],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['numeric', 'digits_between:5,20'],
            'address' => ['string', 'min:3', 'max:255'],
        ]);

        $user->update($data->validated());

        return back()->with('success', 'Profile has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $data = Validator::make($request->all(), [
            'old_password' => ['required', 'string', 'min:8', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password))
                    $fail('Old password does not match');
            }],
            'new_password' => ['required', 'string', 'min:8', 'same:new_password_confirmation'],
        ]);

        $data = $data->validated();

        $user->update([
            'password' => bcrypt($data['new_password'])
        ]);

        return back()->with('success-password', 'Password has been successfully updated');
    }
}
