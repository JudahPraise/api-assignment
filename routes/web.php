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

Route::get('/', 'StudentController@index')->name('student.index');
Route::post('/students', 'StudentController@store')->name('student.store');
Route::put('/student/update/{id}', 'StudentController@update')->name('student.update');
Route::delete('/student/delete/{id}', 'StudentController@delete')->name('student.delete');