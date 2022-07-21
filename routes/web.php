<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

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

// all job listings
Route::get('/', [ListingController::class, 'index'])->name('home');

// show create single job listing
Route::get('/listings/create', [ListingController::class, 'create'])->name('create');

// store a single job listing
Route::post('/listings', [ListingController::class, 'store'])->name('add_job');

// show single job listing
Route::get('/listings/{listing:id}$', [ListingController::class, 'show'])->whereNumber('id')->name('listing');
