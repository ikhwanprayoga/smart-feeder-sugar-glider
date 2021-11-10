<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogJadwal extends Model
{
    protected $table = 'log_jadwal';
    protected $primarykey = 'id';
    protected $fillable = [
        'jadwal_id', 'status', 'alat_id', 'tanggal'
    ];
    public $timestamps = true;

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function jadwal_store()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id')->orderBy('waktu', 'asc');
    }
}
