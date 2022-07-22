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

    Route::prefix('listing')->middleware('auth')->group(function() {
        // Edit form for job listing
        Route::get('/{listing}/edit', 'edit')->name('edit');

        // Update single job listing
        Route::put('/{listing}', 'update')->name('update');

        // Delete single job listing
        Route::delete('/{listing}', 'destroy')->name('delete');
    });

    Route::prefix('listings')->group(function() {

        Route::middleware('auth')->group(function() {
            // Save a single job listing
            Route::post('/', 'store')->name('add');

            // Show create single job listing
            Route::get('/create', 'create')->name('create');

            // Manage user listings
            Route::get('/manage', 'manage')->name('manage');
        });

        // show single job listing
        Route::get('/{listing:id}$', 'show')->whereNumber('id')->name('listing');
    });
});

// registration and login routes
Route::controller(UserController::class)->group(function() {

    Route::middleware('guest')->group(function() {
        // Show user registration form
        Route::get('/register', 'create')->name('register');

        // Save user registration
        Route::post('/users', 'store')->name('register_user');

        // Show user login form
        Route::get('/login', 'login')->name('login');

        // Login User
        Route::post('/login', 'authenticate')->name('auth_login');
    });

    // Logout user
    Route::post('/logout', 'logout')->name('logout');
});
