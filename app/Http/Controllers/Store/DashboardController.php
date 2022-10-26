<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\EasyReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function storeRequests()
   {
    $returns = Auth::user()->storeRequests()->latest()->paginate(5);
    return view('backend.store-return', compact('returns'));
   }

   public function destroyRequest($id)
   {
    $request = EasyReturn::findOrFail($id);

    $request->delete();

    return back()->with('message', 'Request has been deleted');
   }

   public function requestEdit($id)
   {
        $request = EasyReturn::findOrFail($id);

        return view('backend.store-return-edit', compact('request'));
   }

   public function requestUpdate(Request $request, $id)
   {
    $return = EasyReturn::findOrFail($id);

    $return->update(['status' => $request->input('status'), 'comment' => $request->input('comment')]);

    return back()->with('message', 'Return request status has been changed');

   }
}
