<?php

use Illuminate\Http\Request;
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

Route::post('company', [App\Http\Controllers\Api\CompanyController::class, 'index']);
Route::post('create-company', [App\Http\Controllers\Api\CompanyController::class, 'store']);
Route::post('update-company', [App\Http\Controllers\Api\CompanyController::class, 'update']);
Route::post('delete-company', [App\Http\Controllers\Api\CompanyController::class, 'destroy']);
Route::post('detail-company', [App\Http\Controllers\Api\CompanyController::class, 'detail']);

Route::post('employee', [App\Http\Controllers\Api\EmployeeController::class, 'index']);
Route::post('create-employee', [App\Http\Controllers\Api\EmployeeController::class, 'store']);
Route::post('update-employee', [App\Http\Controllers\Api\EmployeeController::class, 'update']);
Route::post('delete-employee', [App\Http\Controllers\Api\EmployeeController::class, 'destroy']);
Route::post('detail-employee', [App\Http\Controllers\Api\EmployeeController::class, 'detail']);
Route::post('balance-employee', [App\Http\Controllers\Api\EmployeeController::class, 'balance']);
Route::post('history', [App\Http\Controllers\Api\TransactionController::class, 'index']);
