<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DifferController;
use App\Http\Controllers\Api\EntriesController;
use App\Http\Controllers\Api\AuthController;

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

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/differ', [DifferController::class, 'generateDiff']);
});


Route::get('/entries', [EntriesController::class, 'index']);
Route::get('/entries/{slug}', [EntriesController::class, 'view']);
Route::post('/entries', [EntriesController::class, 'create']);
Route::put('/entries/{slug}', [EntriesController::class, 'update']);
Route::delete('/entries/{slug}', [EntriesController::class, 'delete']);
