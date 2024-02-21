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

Route::middleware('auth:sanctum')->group(function () {

  // User-related routes
  Route::get('/user', function (Request $request) {
      return $request->user();
  });
  Route::get('auth/logout', [AuthController::class, 'logout']);
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('auth/user', [AuthController::class, 'user']);
  
  // Sanitation Survey Routes
  Route::resource('/sanitation-surveys', SanitationSurveyController::class);
  Route::post('/deleteHouseholdSurveyRecord', [SanitationSurveyController::class, 'delete']);
  Route::put('/sanitation-surveys/{id}', [SanitationSurveyController::class, 'update']);
  
  // Sanitary Permit Routes
  Route::resource('/sanitation-permit', SanitaryPermitController::class);
  Route::post('/deleteEstablishmentSurveyRecord', [SanitaryPermitController::class, 'delete']);
  Route::put('/sanitary-permits/{id}', [SanitaryPermitController::class, 'update']);

});

// Routes accessible without authentication
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
