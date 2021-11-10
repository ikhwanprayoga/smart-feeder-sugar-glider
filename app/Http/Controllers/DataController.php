<?php

namespace App\Http\Controllers;

use App\LogMonitoring;
use Illuminate\Http\Request;
use DataTables;

class DataController extends Controller
{
    private $tanggal = '2021-07-25%';

    public function data()
    {
        $d = LogMonitoring::
        where('created_at', 'like', '2021-07-21%')
        // ->where('created_at', '>', '2021-07-17 10:00')
        ->get();

        return Datatables::of($d)           
        ->addColumn('makanan_persen', function($q){
            return number_format(($q->makanan / 12) * 100 ,0,",",".").' %';
        })
        ->addColumn('air_persen', function($q){
            return number_format(($q->air / 19) * 100 ,0,",",".").' %';
        })

        ->rawColumns(['makanan_persen','air_persen'])->make(true);
    }

    public function ubah()
    {
        return $dd = LogMonitoring::
        where('created_at', 'like', '2021-07-17%')
        // ->where('created_at', '>', '2021-07-17 10:00')
        ->get();

        // foreach ($dd as $key => $d) {
        //     $id = $d->id;
        //     // $ubh = date('Y-m-d H:i:s', strtotime('-3 day', strtotime($d->created_at)));

        //     if ($d->makanan < 12 && $d->air < 19) {
        //         LogMonitoring::where('id', $id)->update([
        //             'makanan' => $d->makanan + 2,
        //             'air' => $d->air + 3,
        //         ]);
        //     }

        // }

        $dd = LogMonitoring::
        where('created_at', 'like', '2021-07-22%')
        ->where('created_at', '>', '2021-07-17 10:00')
        ->get();

        return $dd;
    }
}
