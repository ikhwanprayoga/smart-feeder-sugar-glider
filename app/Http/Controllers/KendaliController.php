<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KendaliController extends Controller
{
    public function index()
    {
        return view('kendali');
    }

    public function alat()
    {
        return view('alat');
    }
}
