<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('auth', 'auth');
});

Route::controller(CompanyController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/company/list', 'index');
    Route::get('/company/{id}', 'show');
    Route::post('/company/new', 'store');
    Route::put('/company/{id}', 'update');
    Route::delete('/company/{id}', 'destroy');
});

Route::controller(EmployeeController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/employee/list', 'index');
    Route::get('/employee/{id}', 'show');
    Route::get('/employee/company/{companyId}', 'employees');
    Route::post('/employee/new', 'store');
    Route::put('/employee/{id}', 'update');
    Route::delete('/employee/{id}', 'destroy');
});
