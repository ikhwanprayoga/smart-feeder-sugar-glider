<?php

namespace App\Http\Controllers;

use App\Jadwal;
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

        $jadwals = Jadwal::where('alat_id', $alat_id)->orderBy('waktu', )->get();
        $q = 0;
        foreach ($jadwals as $key => $jadwal) {
            if ($jadwal->waktu > $timeNow) {
                $s[$q] = $this->hitungDiffDetik($timeNow, $jadwal->waktu);
                $d[$q]['id'] = $jadwal->id;
                $d[$q]['waktu'] = date('H:i', strtotime($jadwal->waktu));
                $d[$q]['diff'] = $this->hitungDiffDetik($timeNow, $jadwal->waktu);
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
