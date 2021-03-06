<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KendaliController extends Controller
{
    public function index()
    {
        return view('kendali');
    }
}
