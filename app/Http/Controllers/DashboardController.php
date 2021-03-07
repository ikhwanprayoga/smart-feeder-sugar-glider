<?php

namespace App\Http\Controllers;

use App\Alat;
use App\Kendali;
use App\LogMonitoring;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $alats = Alat::all();
        $kendalis = Kendali::all();
        $logMonitorings = LogMonitoring::take(5)->get();

        $d = [
            'alats',
            'kendalis',
            'logMonitorings'
        ];

        return view('dashboard', compact($d));
    }
}
