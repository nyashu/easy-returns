<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\EasyReturn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = User::where('role_id', User::STORE)->paginate(5);
        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'numeric', 'digits_between:5,20'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'website' => ['required', 'string', 'min:3', 'max:255'],
            'type' => ['required', 'string', 'in:electronics,furnitures,fashions'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $validated = $data->validated();
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated + ['role_id' => User::STORE]);

        $user->store()->create($validated);
        $user->addMedia(resource_path() . '/img/avatar.png')->preservingOriginal()->toMediaCollection('profile');

        return back()->with('message', 'Store has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = User::findOrFail($id);
        $store->delete();

        return back()->with('message', 'Store has been deleted');
    }

    public function changeStatus(Request $request, $id)
    {
        $store = User::findOrFail($id);

        $store->update([
            'is_verified' => $request->input('status')
        ]);

        if ($store->is_verified)
            return back()->with('message', 'Store has been verified');
        else
            return back()->with('message', 'Store has been unverified');
    }

    public function homepageStore()
    {
        $stores = User::where('role_id', User::STORE)->get();
        return view('stores.home-store', compact('stores'));
    }

    public function shareLink()
    {
        return view('link');
    }

    public function storeUser()
    {
        $users = User::withCount(['returns' => function ($query) {
            $query->where('store_id', Auth::user()->id);
        }])->orderBy('returns_count', 'DESC')
            ->paginate(5);

        return view('stores.store-user', compact('users'));
    }
}
