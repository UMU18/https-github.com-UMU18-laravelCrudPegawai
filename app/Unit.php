<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function data() {
    return $this->hasMany('App\Data', 'ID_Unit');
	}
    protected $table = 'unit';
    
}
