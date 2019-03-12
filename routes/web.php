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


Route::resource('workouts','WorkoutController');

// Route::get('/workouts', index());

// Route::get('/workouts/create', create());

// Route::post('workouts', store());

// Route::get('/workouts/{workout}', show());

// Route::get('workouts/{workout}/edit', edit());

// Route::put('/workouts/{workout}', update());

// Route::delete('/workouts/{workout}', destroy());