<?php

namespace App\Http\Controllers;

use App\Alat;
use App\Jadwal;
use App\LogJadwal;
use App\LogMonitoring;
use App\Monitoring;

class ApiController extends Controller
{
    public function kirim_data($alat_id, $makanan, $air)
    {
        $status_pakan = false;

        //cek waktu sekarang
        $today = date('Y-m-d');
        $now = date('H:i:s');

        $jadwals = Jadwal::where('alat_id', $alat_id)->orderBy('waktu', 'asc')->get();

        foreach ($jadwals as $key => $jadwal) {
            
            if ($now >= $jadwal->waktu) {
                // return $jadwal;
                //cek data log terakhir
                $lastLog = LogJadwal::where('jadwal_id', $jadwal->id)->where('tanggal', $today)->first();
                
                // apakah terdapat log jadwal terakhir
                if (isset($lastLog)) {
        
                    // jika ada, cek apakah waktu skrg lewat dri log terakhir
                    // if ($now >= $lastLog->jadwal->waktu && $today == $lastLog->tanggal) {
                    if ($lastLog->status == 0) {
        
                        //ubah sttus pakan alat jadi true
                        $status_pakan = true;
                        Alat::where('id', $alat_id)->first()->update([
                            'status_pakan' => $status_pakan
                        ]);
        
                    }
        
                } else {
                    // jika tidak ada
                    // cek waktu skrg, bandingkan dg jadwal terdekat selanjutnya
                    // $jadwalB = Jadwal::where('alat_id', $alat_id)->where('waktu', '>=', $now)->orderBy('waktu', 'asc')->first();
                    // if (isset($jadwalB)) {
                        LogJadwal::create([
                            'jadwal_id' => $jadwal->id,
                            'alat_id' => $alat_id,
                            'tanggal' => $today,
                            'status' => 0
                        ]);
                    // } 
                    
                }
            }

        }

        Monitoring::updateOrCreate(
            [
                'alat_id' => $alat_id
            ],[
                'makanan' => $makanan,
                'air' => $air,
                'status_pakan' => $status_pakan
            ]);

        LogMonitoring::create([
            'alat_id' => $alat_id,
            'makanan' => $makanan,
            'air' => $air,
            'status_pakan' => $status_pakan
        ]);

        return 'update data monitoring success';
        
    }

    public function kirim_datas($alat_id, $makanan, $air)
    {
        $status_pakan = false;

        //cek waktu sekarang
        $today = date('Y-m-d');
        $now = date('H:i:s');

        //cek data log terakhir
        $lastLog = LogJadwal::where('alat_id', $alat_id)->where('tanggal', $today)->where('status', 0)->orderBy('id', 'desc')->first();
        
        // apakah terdapat log jadwal terakhir
        if (isset($lastLog)) {

            // jika ada, cek apakah waktu skrg lewat dri log terakhir
            if ($now >= $lastLog->jadwal->waktu && $today == $lastLog->tanggal) {

                //ubah sttus pakan alat jadi true
                $status_pakan = true;
                Alat::where('id', $alat_id)->first()->update([
                    'status_pakan' => $status_pakan
                ]);

            }

        } else {
            // jika tidak ada
            // cek waktu skrg, bandingkan dg jadwal terdekat selanjutnya
            $jadwalB = Jadwal::where('alat_id', $alat_id)->where('waktu', '>=', $now)->orderBy('waktu', 'asc')->first();
            if (isset($jadwalB)) {
                LogJadwal::create([
                    'jadwal_id' => $jadwalB->id,
                    'alat_id' => $alat_id,
                    'tanggal' => $today,
                    'status' => 0
                ]);
            } 
            
        }

        Monitoring::updateOrCreate(
            [
                'alat_id' => $alat_id
            ],[
                'makanan' => $makanan,
                'air' => $air,
                'status_pakan' => $status_pakan
            ]);

        LogMonitoring::create([
            'alat_id' => $alat_id,
            'makanan' => $makanan,
            'air' => $air,
            'status_pakan' => $status_pakan
        ]);

        return 'update data monitoring success';
        
    }
    public function kirim_data_old($alat_id, $makanan, $air)
    {
        $status_pakan = false;

        //cek waktu sekarang
        $now = date('H:i');
        
        //cek data log terakhir
        $lastLog = LogJadwal::where('alat_id', $alat_id)->where('status', 0)->orderBy('id', 'desc')->first();
        
        //jika data tidak tersedia
        if (!isset($lastLog)) {
            
            //ambil jadwal paling dekat dg waktu sekarang
            $jadwalA = Jadwal::where('alat_id', $alat_id)->where('waktu', '<=', $now)->orderBy('waktu', 'desc')->first();

            if (!isset($jadwalA)) {
                $jadwalB = Jadwal::where('alat_id', $alat_id)->orderBy('waktu', 'desc')->first();
                LogJadwal::create([
                    'jadwal_id' => $jadwalB->id,
                    'alat_id' => $alat_id,
                    'status' => 1
                ]);
            } 

            //buat log jadwal yg seakan-akan pakan sudah di siapkan
            LogJadwal::create([
                'jadwal_id' => $jadwalA->id,
                'alat_id' => $alat_id,
                'status' => 1
            ]); 

        }

        //ambil data log jadwal terakhir
        $cekLogJadwal = LogJadwal::where('alat_id', $alat_id)->orderBy('id', 'desc')->first();

        //cek apakah waktu sekarang lebih dari log jadwal terakhir
        if ($now >= $cekLogJadwal->jadwal->waktu) {
            $cekJadwal = Jadwal::where('alat_id', $alat_id)->where('waktu', '<=', $now)->orderBy('waktu', 'desc')->first();
            LogJadwal::create([
                'jadwal_id' => $cekJadwal->id,
                'alat_id' => $alat_id,
                'status' => 0
            ]);

            $status_pakan = true;

            //ubah sttus pakan alat jadi true
            Alat::where('id', $alat_id)->first()->update([
                'status_pakan' => $status_pakan
            ]);
        }

        Monitoring::updateOrCreate(
            [
                'alat_id' => $alat_id
            ],[
                'makanan' => $makanan,
                'air' => $air,
                'status_pakan' => $status_pakan
            ]);

        LogMonitoring::create([
            'alat_id' => $alat_id,
            'makanan' => $makanan,
            'air' => $air,
            'status_pakan' => $status_pakan
        ]);

        return 'update data monitoring success';
    }

    public function monitoring($alat_id)
    {
        $data = Monitoring::where('alat_id', $alat_id)->first();

        $d =[
            'makanan' => number_format(($data->makanan / 12) * 100 ,0,",","."),
            'air' => number_format(($data->air / 19) * 100 ,0,",","."),
        ];

        return response()->json($d, 200);
    }

    public function last_time($alat_id)
    {
        $timeNow = date('H:i:s');

        $jadwals = Jadwal::where('alat_id', $alat_id)->orderBy('waktu', 'desc')->get();
        $q = 0;
        foreach ($jadwals as $key => $jadwal) {
            // if ($jadwal->waktu > $timeNow) {
                $s[$q] = $this->hitungDiffDetik($timeNow, $jadwal->waktu);
                $d[$q]['id'] = $jadwal->id;
                $d[$q]['waktu'] = date('H:i', strtotime($jadwal->waktu));
                $d[$q]['diff'] = $this->hitungDiffDetik($timeNow, $jadwal->waktu);
                $q = $q + 1;
            // }
        }

        $indexMin = array_keys($s, min($s));
        
        $timeLast = $d[$indexMin[0]];

        return $timeLast;
    }

    public function get_status($alat_id)
    {
        $alat = Alat::where('id', $alat_id)->first();

        if ($alat->status_pakan) {
            return 1;
        } else {
            return 0;
        }
        
    }

    public function store_status($alat_id)
    {
        $today = date('Y-m-d');
        $alat = Alat::where('id', $alat_id)->first();
        
        $jadwal = Jadwal::where('alat_id', $alat_id)->with('log_jadwal')->whereHas('log_jadwal', function ($q) use ($today) {
            $q->where([['tanggal', $today], ['status', 0]]);
        })->orderBy('waktu', 'asc')->first();

        $logJadwal = LogJadwal::where('jadwal_id', $jadwal->id)->where('tanggal', $today)->where('status', 0)->first();

        if (!isset($logJadwal)) {
            return 'no log jadwal';
        }
        
        $alat->update(['status_pakan' => 0]);
        $logJadwal->update(['status' => 1]);
        
        return 'store success';
    }

    public function hitungDiffDetik($start, $finish)
    {
        $dif = strtotime($finish) - strtotime($start);

        return $dif;
    }
}
