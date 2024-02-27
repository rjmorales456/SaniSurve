<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SanitaryPermitController;
use App\Http\Controllers\SanitationSurveyController;

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

// Create User Function
Route::middleware('admin')->post('/users', [AuthController::class, 'createUser']);
Route::get('/users', [AuthController::class, 'getUsers']);

// User Functions
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);

});
;


//Filter dashboard
Route::get('/dashboard-filter', [SanitationSurveyController::class, 'filterDashboard']);

// Dasboards

Route::get('/answered-surveys', [DashboardController::class, 'answeredSurvey']);

Route::get('/total-occupant-survey', [DashboardController::class, 'TotalOccupants']);

Route::get('/avg-family-number', [DashboardController::class, 'AvgFamily']);

Route::get('/property-ownership', [DashboardController::class, 'propertyOwnership']);

// Shared Household
Route::get('/shared-household', [DashboardController::class, 'sharedHousehold']);

// Waste Segregation
Route::get('/waste-segregation', [DashboardController::class, 'wasteSegregation']);

// Waste Collected
Route::get('/waste-collected', [DashboardController::class, 'wasteCollected']);

// Reuse and Recycle
Route::get('/recycle-and-reuse', [DashboardController::class, 'RecycleandReuse']);


// Property Ownership

Route::get('/property-ownership', [DashboardController::class, 'propertyOwnership']);
