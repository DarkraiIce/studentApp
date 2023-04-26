<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Degree;
use App\Models\Lecturer;

class Student extends Model
{
	public function degrees()
	{
    	return $this->belongsToMany('App\Models\Degree');
    }

    public function lecturers()
    {
    	return $this->belongsToMany('App\Models\Lecturer');
    }
}
