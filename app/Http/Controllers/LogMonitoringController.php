<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class LogMonitoringController extends Controller
{
    public function index()
    {
        return view('log-monitoring');
    }

    public function get_data(Request $request)
    {
        $data = DB::table('log_monitoring');

        return datatables()->of($data)->toJson();
    }
}
