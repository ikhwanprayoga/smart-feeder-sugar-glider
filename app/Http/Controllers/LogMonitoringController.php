<?php

namespace App\Http\Controllers;

use App\Alat;
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

        if ($request->has('filter_tanggal_mulai') && $request->has('filter_tanggal_mulai') && $request->input('filter_tanggal_mulai') != null && $request->input('filter_tanggal_mulai') != null) {
            $mulai = date('Y-m-d', strtotime($request->filter_tanggal_mulai));
            $akhir = date('Y-m-d', strtotime($request->filter_tanggal_akhir));
            $data->whereBetween('created_at', [$mulai, $akhir]);
        }

        return datatables()->of($data)
        ->addColumn('waktu', function ($data) {
            return date('d-m-Y H:i', strtotime($data->created_at));
        })
        ->addColumn('nama_alat', function ($data) {
            $alat = Alat::where('id', $data->alat_id)->first();

            return $alat->nama;
        })
        ->editColumn('makanan', function ($data) {
            return number_format(($data->makanan / 12) * 100 ,0,",","."). ' %';
        })
        ->editColumn('air', function ($data) {
            return number_format(($data->air / 19) * 100 ,0,",","."). ' %';
        })
        ->toJson();
    }
}
