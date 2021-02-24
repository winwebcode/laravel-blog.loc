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

    public function store()
    {

    }
}
