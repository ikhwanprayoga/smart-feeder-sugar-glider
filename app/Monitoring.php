<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $table = 'monitoring';
    protected $primarykey = 'id';
    protected $fillable = [
        'alat_id', 'makanan', 'air'
    ];
    public $timestamps = true;
}
