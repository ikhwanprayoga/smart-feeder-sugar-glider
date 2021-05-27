<?php

namespace App\Http\Controllers\Admin;

use App\Alat;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', 1)->count();
        $alat = Alat::count();

        $d = [
            'user',
            'alat'
        ];
        return view('admin.dashboard.index', compact($d));
    }
}
