<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

// Show all listings
Route::get('/', [ListingController::class, 'index'])
    ->name('homepage');

// Add listing page
Route::get('/listings/create', [ListingController::class, 'create'])
    ->middleware('auth');

// Add listing handler
Route::post('/listings', [ListingController::class, 'store']);

// Edit listing page
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
    ->middleware('auth');

// Edit listing handler
Route::put('/listings/{listing}', [ListingController::class, 'update'])
    ->middleware('auth');

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
    ->middleware('auth');

// Show single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Register page
Route::get('/register', [UserController::class, 'create'])
    ->middleware('guest');

// Register handler
Route::post('/users', [UserController::class, 'store'])
    ->middleware('guest');

// Logout handler
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');

// Login page
Route::get('/login', [UserController::class, 'login'])
    ->name('login')
    ->middleware('guest');

// Login handler
Route::post('/users/authenticate', [UserController::class, 'authenticate'])
    ->middleware('guest');
