<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\WorldController;
use App\Http\Controllers\MovieController;


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
Route::any('/', function(){return view('angular');})->where('any', '^(?!api).*$')->name('index');
Route::any('people', [PeopleController::class, 'store'])->where('any', '^(?!api).*$')->name('people-store');
Route::any('world', [WorldController::class, 'store'])->where('any', '^(?!api).*$')->name('world.store');
Route::any('movie', [MovieController::class, 'store'])->where('any', '^(?!api).*$')->name('movie.store');

