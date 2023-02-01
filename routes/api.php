<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Auth Rotas
 */
Route::controller(AuthController::class)
    ->group(function () {
        Route::post('/login', 'login');
        Route::get('/verify', 'verifyToken')->middleware(['auth:sanctum']);
        Route::post('/logout', 'logout')->middleware(['auth:sanctum']);
        Route::post('/register', 'register');
    });

Route::prefix('/donation')
    ->middleware(['auth:sanctum'])
    ->controller(DonationController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/my-donations', 'myDonation');
        Route::post('/', 'create');
        Route::put('/{donation}', 'update');
    });

Route::prefix('/category')
    ->middleware(['auth:sanctum'])
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/dropdown', 'dropdown');
    });

Route::prefix('/user')
    ->middleware(['auth:sanctum'])
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/me', 'me');
        Route::post('/', 'create');
        Route::get('/dropdown', 'dropdown');
        Route::get('/{user}', 'show');
    });

Route::prefix('/address')
    ->middleware(['auth:sanctum'])
    ->controller(AddressController::class)
    ->group(function () {
        Route::get('/{address}', 'show');
        Route::post('/', 'create');
        Route::put('/{address}', 'update');
    });
