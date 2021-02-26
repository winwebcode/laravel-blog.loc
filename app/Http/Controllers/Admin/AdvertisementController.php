<?php

namespace App\Http\Controllers\Admin;

use App\Advertisment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{

    public function index()
    {
        //show advertisment codes
        $ads = Advertisment::all();

        return view('admin.advertisment.index', compact('ads'
        ));
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required'
        ]);
        $ad = Advertisment::find($id);
        $ad->editCodes($request->all());
        return redirect()->route('advertisement.index');
    }
}
