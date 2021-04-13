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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('dynamic_field','DynamicFieldController@index');
Route::get('/dynamic_field', [App\Http\Controllers\DynamicFieldController::class, 'index']);

Route::post('dynamic_field/insert',[App\Http\Controllers\DynamicFieldController::class, 'insert'])->name('dynamic_field.insert');
