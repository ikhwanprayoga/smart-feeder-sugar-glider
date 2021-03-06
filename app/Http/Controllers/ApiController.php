<?php

namespace App\Http\Controllers;

use App\LogMonitoring;
use App\Monitoring;
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
}
