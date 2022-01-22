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
Auth::routes();

Route::get('/testprofile', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/addlink', [\App\Http\Controllers\HomeController::class, 'addlink'])->name('addlink');
Route::post('/updatelink', [\App\Http\Controllers\HomeController::class, 'updatelink'])->name('updatelink');

Route::get('/editprofile', [\App\Http\Controllers\HomeController::class, 'editprofile'])->name('editprofile');
Route::post('/updateprofile', [\App\Http\Controllers\HomeController::class, 'updateprofile'])->name('updateprofile');