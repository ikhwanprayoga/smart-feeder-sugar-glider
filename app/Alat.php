<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama'
    ];
    public $timestamps = true;
}
