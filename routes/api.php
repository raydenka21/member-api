<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\UsersController;

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


$router->group(['prefix' => 'users'], function () use ($router) {
    $router->post('/check-email', [UsersController::class, 'CheckEmail']);
    $router->post('/auth', [UsersController::class, 'auth']);
    $router->post('/register', [UsersController::class, 'register']);

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/awards', [AwardsController::class, 'index']);
});

