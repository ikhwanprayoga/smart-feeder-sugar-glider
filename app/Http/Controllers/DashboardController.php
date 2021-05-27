<?php

namespace App\Http\Controllers;

use App\Alat;
use App\Jadwal;
use App\LogMonitoring;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $alats = Alat::all();
        $jadwals = Jadwal::all();
        $logMonitorings = LogMonitoring::take(5)->get();

        $d = [
            'alats',
            'jadwals',
            'logMonitorings'
        ];

        return view('dashboard', compact($d));
    }
}
