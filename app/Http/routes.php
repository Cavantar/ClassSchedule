<?php

/*
   |--------------------------------------------------------------------------
   | Application Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register all of the routes for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
 */


Route::resource('teacher', 'TeacherController');
Route::resource('student', 'StudentController');
Route::resource('schoolclass', 'SchoolclassController');
Route::resource('classroom', 'ClassroomController');
Route::resource('plan', 'PlanController');
Route::resource('planentry', 'PlanEntryController');

Route::controller('/', 'HomeController');

/*
   Route::get('/', function () {
   //return view('default');
   return Redirect::to('plan');
   });
 */
/*
   Route::get('/default', function () {
   //return view('default');
   return view('default');
   });
 */
// Route::get('/', 'PlanController@index');
