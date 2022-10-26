<?php

namespace App\Http\Controllers\Return;

use App\Http\Controllers\Controller;
use App\Models\EasyReturn;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Auth::user()->returns()->latest()->paginate(5);
        $verified = Auth::user()->returns()->where('status','verified')->count();
        $pending = Auth::user()->returns()->where('status','pending')->count();
        $rejected = Auth::user()->returns()->where('status','rejected')->count();
        $inprogress = Auth::user()->returns()->where('status','inprogress')->count();
        
        return view('return.index', compact('requests','verified','pending','rejected','inprogress'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->query('store')) {
            $storeID = User::where('id', $request->query('store'))->first();
        }

        $stores = User::where('role_id', User::STORE)->get();
        return view('return.return', compact('stores', isset($storeID) ? 'storeID' : null));
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
            'store' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:3', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0'],
            'file' => ['required'],
            'file.*' => ['mimes:jpg,jpeg,png']
        ]);

        $data = $data->validated();

        $return = EasyReturn::create([
            'user_id' => auth()->user()->id,
            'store_id' => $data['store'],
            'price' => $data['price'],
            'description' => $data['description'],
            'status' => 'pending'
        ]);

        if ($request->hasFile('file')) {
            $return->addMultipleMediaFromRequest(['file'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('return');
                });
        }

        return back()->with('success', 'Your request has been submitted. It will take some moment to verify');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EasyReturn  $easyReturn
     * @return \Illuminate\Http\Response
     */
    public function show(EasyReturn $easyReturn)
    {
        $request = $easyReturn;
        return view('return.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EasyReturn  $easyReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(EasyReturn $easyReturn)
    {
        return view('return.edit', compact('easyReturn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EasyReturn  $easyReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EasyReturn $easyReturn)
    {
        $easyReturn->update([
            'comment' => $request->input('comment')
        ]);

        return back()->with('message', 'Return Request has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EasyReturn  $easyReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(EasyReturn $easyReturn)
    {
        $easyReturn->delete();

        return back()->with('success', 'Return request has been deleted');
    }
}
