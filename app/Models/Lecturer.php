<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Degree;
use App\Models\Student;

class Lecturer extends Model
{
    public function students()
    {
    	return $this->belongsToMany('App\Models\Student');
    }

    public function degrees()
    {
    	return $this->belongsToMany('App\Models\Degree');
    }
}
