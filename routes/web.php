<?php

use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
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

Route::get('/', "PagesController@home");
Route::get('/about', "PagesController@about");
Route::prefix("/chat")->group(function(){
    Route::get('/', "MessangerController@index");
    Route::get('/{id}', "MessangerController@detail");
});
Route::prefix("/profile")->group(function(){
    Route::get('/', "ProfileController@index");
    Route::post('/delete', "ProfileController@delete");
    Route::post('/update', "ProfileController@update");
    Route::post('/foto', "ProfileController@foto");
});

Route::get("/distance", "PagesController@distance");


Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
