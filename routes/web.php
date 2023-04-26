<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/students/index', function() {
    return view('students');
});

//Resource Controllers
Route::resource('/courses', 'App\Http\Controllers\CourseController');
Route::resource('/degrees', 'App\Http\Controllers\DegreeController');
Route::resource('/students', 'App\Http\Controllers\StudentController');
Route::resource('/lecturers', 'App\Http\Controllers\LecturerController');

//Student Controllers
Route::get('students', 'App\Http\Controllers\StudentController@index');

//Lecturer Controllers
Route::get('/tutor/{id}', 'App\Http\Controllers\LecturerController@lecturers');

//Degree Controllers
Route::get('/degree/{id}', 'App\Http\Controllers\DegreeController@degrees');
Route::get('/degree/{id}/students', 'App\Http\Controllers\DegreeController@students');

//Course Controllers
Route::get('/course/{id}', 'App\Http\Controllers\CourseController@courses');
Route::get('/course/{id}/degrees', 'App\Http\Controllers\CourseController@degrees');