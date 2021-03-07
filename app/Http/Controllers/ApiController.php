<?php

namespace App\Http\Controllers;

use App\Kendali;
use App\LogMonitoring;
use App\Monitoring;
use DateTime;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function kirim_data($alat_id, $makanan, $air)
    {
        Monitoring::updateOrCreate(
            [
                'alat_id' => $alat_id
            ],[
                'makanan' => $makanan,
                'air' => $air
            ]);

        LogMonitoring::create([
            'alat_id' => $alat_id,
            'makanan' => $makanan,
            'air' => $air,
        ]);

        return true;
    }

    public function monitoring($alat_id)
    {
        $data = Monitoring::where('alat_id', $alat_id)->first();

        return response()->json($data, 200);
    }

    public function last_time($alat_id)
    {
        $timeNow = date('H:i');

        $kendalis = Kendali::where('alat_id', $alat_id)->orderBy('waktu', )->get();
        $q = 0;
        foreach ($kendalis as $key => $kendali) {
            if ($kendali->waktu > $timeNow) {
                $s[$q] = $this->hitungDiffDetik($timeNow, $kendali->waktu);
                $d[$q]['id'] = $kendali->id;
                $d[$q]['waktu'] = date('H:i', strtotime($kendali->waktu));
                $d[$q]['diff'] = $this->hitungDiffDetik($timeNow, $kendali->waktu);
                $q = $q + 1;
            }
        }

        $indexMin = array_keys($s, min($s));
        
        $timeLast = $d[$indexMin[0]];

        return $timeLast;
    }

    public function hitungDiffDetik($start, $finish)
    {
        return strtotime($finish) - strtotime($start);
    }
}
