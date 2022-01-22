<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Link;
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

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/addlink', [\App\Http\Controllers\HomeController::class, 'addlink'])->name('addlink');
Route::post('/updatelink', [\App\Http\Controllers\HomeController::class, 'updatelink'])->name('updatelink');
Route::post('/deletelink', [\App\Http\Controllers\HomeController::class, 'deletelink'])->name('deletelink');

Route::get('/editprofile', [\App\Http\Controllers\HomeController::class, 'editprofile'])->name('editprofile');
Route::post('/updateprofile', [\App\Http\Controllers\HomeController::class, 'updateprofile'])->name('updateprofile');

Route::get('/{url}', function ($url) {
     // Get user by URL
     $user = User::where('url', $url)->first();
     if($user){
         // Get all links from user
         $links = Link::where('user_id', $user->id)->get();
         return view('profile')->with('user', $user)->with('links', $links);
     }else{
         return view('welcome');
     }
});