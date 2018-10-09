<?php

//index -> list
//store -> create
//delete -> destory
//edit -> PUT

Route::get('/tasks', 'TasksController@index');
Route::get('/', 'TasksController@index');
Route::post('/tasks', 'TasksController@store');
Route::delete('/tasks/{id}', 'TasksController@destroy');
Route::put('/tasks/{id}', 'TasksController@update');
Route::put('/tasks', 'TasksController@completar');
Route::get('/task_edit/{id}', 'TasksController@edit');

Route::get('/about', function () {
    return view('about');
});

Route::view('/calendari', 'calendari');

Route::get('/tasks_vue', 'TasksVueController@index');
