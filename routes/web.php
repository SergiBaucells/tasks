<?php

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
Route::resource('tasks', 'TasksController');
//Route::get('/tasks','TasksController@index');
//Route::post('/tasks','TasksController@store');
//Route::delete('/tasks/{id}','TasksController@destroy');
//Route::get('/tasks/{id}/edit','TasksController@edit');
//Route::put('/tasks/{id}','TasksController@update');

Route::get('/about', function () {
    return view('about');
});

Route::view('/contact', 'contact');

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/prova','ProvaController@show');
Route::get('/prova', function () {
    dd('Hola');
});

Route::redirect('/hola', '/prova');