<?php

use App\Jadwal;
use App\LogJadwal;

function cek_status_pengolahan_pakan ($jadwalId) {
        $today = date('Y-m-d');
        $logJadwal = LogJadwal::where('jadwal_id', $jadwalId)->where('created_at', 'like', '%'.$today.'%')->first();
        if (isset($logJadwal->status) && $logJadwal->status == 1) {
                return 'Pakan telah di olah';
        } else {
                return 'Pengolahan pakan belum dilakukan';
        }
}