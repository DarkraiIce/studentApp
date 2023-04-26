<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Student;

class Degree extends Model
{
    public function students()
    {
    	return $this->belongsToMany('App\Models\Student');
    }

    public function lecturers()
    {
    	return $this->belongsToMany('App\Models\Lecturer');
    }

    public function courses()
    {
    	return $this->belongsToMany('App\Models\Course');
    }
}
