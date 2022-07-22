<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

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

Route::controller(ListingController::class)->group(function() {
    // all job listings
    Route::get('/', 'index')->name('home');

    Route::prefix('listing')->group(function() {
        // Edit form for job listing
        Route::get('/{listing}/edit', 'edit')->name('edit');

        // Update single job listing
        Route::put('/{listing}', 'update')->name('update');

        // Delete single job listing
        Route::delete('/{listing}', 'destroy')->name('delete');
    });

    Route::prefix('listings')->group(function() {
        // Save a single job listing
        Route::post('/', 'store')->name('add');

        // Show create single job listing
        Route::get('/create', 'create')->name('create');

        // show single job listing
        Route::get('/{listing:id}$', 'show')->whereNumber('id')->name('listing');
    });
});

// Show user registration form
Route::get('/register', [UserController::class, 'create'])->name('register');

// Save user registration
Route::post('/users', [UserController::class, 'store'])->name('register_user');

// Show user login form
Route::get('/login', [UserController::class, 'login'])->name('login');

// Login User
Route::post('/login', [UserController::class, 'authenticate'])->name('auth_login');

// Logout user
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Manage user listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->name('manage');
