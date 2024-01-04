<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationsController;
use App\Http\Controllers\SpotsController;
use App\Http\Controllers\VaccinationsController;
use App\Models\Consultations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
    // Route::middleware('CheckAuthMiddleware')->group(function () {
        Route::post('/consultations', [ConsultationsController::class, 'store']);
        Route::get('/consultations', [ConsultationsController::class, 'show']);
        
        Route::get('/spots', [SpotsController::class, 'index']);
        Route::get('/spots/{id}', [SpotsController::class, 'show']);
        
        Route::post('/vaccinations', [VaccinationsController::class, 'register']);
        Route::get('/vaccinations', [VaccinationsController::class, 'getAllVaccine']);
    // });
});