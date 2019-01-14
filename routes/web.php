<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\LoggedUserPhotoController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::post('/tasks', 'TasksController@store');
    Route::delete('/tasks/{id}', 'TasksController@destroy');
    Route::put('/tasks/{id}', 'TasksController@update');
    Route::get('/task_edit/{id}', 'TasksController@edit');
    Route::get('/about', function () {
        return view('about');
    });
    Route::view('/calendari', 'calendari');
    Route::get('/tasks_vue', 'TasksVueController@index');
    Route::get('/tasques', 'TasquesController@index');
    Route::get('/home', 'TasquesController@index');
    // Propies
    Route::post('/taskscompleted/{task}', 'TasksCompletedController@store');
    Route::delete('/taskscompleted/{task}', 'TasksCompletedController@destroy');
    Route::get('/tasks', 'TasksController@index');
    Route::get('/', 'TasksController@index');
    // User tasks
    Route::get('/user/tasks', 'LoggedUserTasksController@index');
    Route::impersonate();
    // Tags
    Route::get('/tags', 'TagsController@index');

    Route::get('/profile', '\\'. ProfileController::class . '@show');


    Route::post('/photo', '\\'. PhotoController::class . '@store');


    Route::get('/user/photo', '\\'. LoggedUserPhotoController::class . '@show');

    //Changelog
    Route::get('/changelog','\\'. ChangelogController::class . '@index');
//    Route::get('/changelog/module/{module}','Tenant\Web\ChangelogModuleController@index');
//    Route::get('/changelog/user/{user}','Tenant\Web\ChangelogUserController@index');
//    Route::get('/changelog/loggable/{loggable}/{loggableId}','Tenant\Web\ChangelogLoggableController@index');
});

Route::post('/login_alt', 'Auth\LoginAltController@login');

Route::post('/register_alt', 'Auth\RegisterAltController@store');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Login Facebook
//Route::get('/auth/facebook', '\\' . LoginController::class . '@redirectToProvider');
//Route::get('/auth/facebook/callback', '\\' . LoginController::class . '@handleProviderCallback');

// Login GitHub
//Route::get('/auth/github', '\\' . LoginController::class . '@redirectToProvider');
//Route::get('/auth/github/callback', '\\' . LoginController::class . '@handleProviderCallback');

Route::get('/auth/{provider}', '\\' . LoginController::class . '@redirectToProvider');
Route::get('/auth/{provider}/callback', '\\' . LoginController::class . '@handleProviderCallback');