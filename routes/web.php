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

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::resource('user','UserController');
Route::post('/getUserData','UserController@getUserData');

Route::get('users/export/', [UserController::class, 'export']);
