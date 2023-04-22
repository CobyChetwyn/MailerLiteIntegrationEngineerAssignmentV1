<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\subscribers\table;

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

$controller_path = 'App\Http\Controllers';

Route::get('/', $controller_path . '\subscribers\Table@showTable')->name('pages-home');
Route::post('/api-key', $controller_path . '\authentications\ApiKeys@index')->name('pages-test');
Route::resource('/subscriber-management', Table::class);
