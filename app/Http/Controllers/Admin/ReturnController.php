<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EasyReturn;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function returnRequests()
    {
        $returns = EasyReturn::latest()->paginate(5);
        return view('backend.all-return', compact('returns'));
    }

    public function destroyRequest($id)
    {
        $request = EasyReturn::findOrFail($id);

        $request->delete();

        return back()->with('message', 'Request has been deleted');
    }
}
