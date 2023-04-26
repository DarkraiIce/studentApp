<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Degree;

class Course extends Model
{
	public function degrees()
	{
    	return $this->belongsToMany('App\Models\Degree');
    }
}
