<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama', 's'
    ];
    public $timestamps = true;

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
