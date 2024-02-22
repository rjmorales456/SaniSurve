<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanitationSurveyController;
use App\Http\Controllers\SanitaryPermitController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Household Survey Functions
Route::resource('/sanitation-surveys', SanitationSurveyController::class);
Route::get('/sanitation-surveys', [SanitationSurveyController::class, 'get']);
Route::post('/deleteHouseholdSurveyRecord', [SanitationSurveyController::class, 'delete']);
Route::put('/sanitation-surveys/{id}', [SanitationSurveyController::class, 'update']);

// Establishment Permit Functions
Route::resource('/sanitation-permit', SanitaryPermitController::class);
Route::get('/sanitation-permit', [SanitaryPermitController::class, 'get']);
Route::post('/deleteEstablishmentSurveyRecord', [SanitaryPermitController::class, 'delete']);
Route::put('/sanitary-permits/{id}', [SanitaryPermitController::class, 'update']);

// User Functions
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
      
});;
