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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/{date?}', ['uses' => 'WorkerController@index', 'as' => 'home' ])
    ->where('date', '[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$');

Route::post('/create-employer', ['uses' => 'WorkerController@store', 'as' => 'store-employer' ]);
Route::post('/add-premium', ['uses' => 'PaymentController@store', 'as' => 'add-premium' ]);