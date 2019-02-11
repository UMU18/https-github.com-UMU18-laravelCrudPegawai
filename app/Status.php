<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function data() {
    return $this->hasMany('App\Data', 'ID_Status');
	}
    protected $table = 'status';
    
}
