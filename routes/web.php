<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UsersController;
use App\Models\Listings;
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

Route::get('/', [ListingsController::class, 'index']);

Route::get('/create', [ListingsController::class, 'create']);

Route::post('/listings', [ListingsController::class, 'store']);

Route::get('/listins/{listing}/edit', [ListingsController::class, 'edit']);

Route::put('/listings/{listing}', [ListingsController::class, 'update']);

Route::delete('/listings/{listing}', [ListingsController::class, 'destroy']);

Route::get('/listings/{listing}', [ListingsController::class, 'show']);


Route::get('/register', [UsersController::class, 'register']);

Route::post('/users', [UsersController::class, 'store']);
