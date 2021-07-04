<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primarykey = 'id';
    protected $fillable = [
        'alat_id', 'waktu'
    ];
    public $timestamps = true;

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function log_jadwal()
    {
        return $this->hasMany(LogJadwal::class);
    }
}
