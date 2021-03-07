<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendali extends Model
{
    protected $table = 'kendali';
    protected $primarykey = 'id';
    protected $fillable = [
        'alat_id', 'waktu'
    ];
    public $timestamps = true;

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}
