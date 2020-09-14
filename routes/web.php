<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth'])->group(function(){
    Route::get('/', 'MemberController@index');//Atsijungus nukreipia tiesiai i login puslapy
    Route::resource('members', 'MemberController');
    Route::resource('reservoirs', 'ReservoirController');
});

Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home'); //<-- prisijungus nuemta i laravel dash borda su užrašu kad ivyko prisijungimas


//Atsijungus numeta i pagrindini laravel puslapį
// Route::get('/', function () {
//     return view('welcome');
// });