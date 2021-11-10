<?php

namespace App;

Use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LogMonitoring extends Model
{
    protected $table = 'log_monitoring';
    protected $primarykey = 'id';
    protected $fillable = [
        'alat_id', 'makanan', 'air', 'status_pakan'
    ];
    public $timestamps = true;

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}
