<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    public function status(){
        return $this->belongsTo('App\Status', 'ID_Status');
    }

    public function unit(){
        return $this->belongsTo('App\Unit', 'ID_Unit');
    }

    protected $table = 'pegawai';
    protected $primaryKey = 'NIK';
    public $timestamps = false;
    
}
