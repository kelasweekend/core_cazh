<?php

use Illuminate\Support\Facades\Auth;
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

Route::redirect('/', '/login');

Auth::routes([
    'reset'    => false,  // for resetting passwords 
    'confirm'  => false,  // for additional password confirmations
    'verify'   => false,  // for email verification
    'register' => false, // for register account
]);

Route::get('no1', [App\Http\Controllers\HomeController::class, 'nomor1']);
Route::get('no2', [App\Http\Controllers\HomeController::class, 'nomor2']);
Route::get('no3', [App\Http\Controllers\HomeController::class, 'nomor3']);
Route::get('no4', [App\Http\Controllers\HomeController::class, 'nomor4']);

Route::prefix('v1')->middleware('auth')->group(function () {
    Route::get('', [App\Http\Controllers\V1\IndexController::class, 'index'])->name('index');

    Route::prefix('companies')->group(function () {
        Route::get('', [App\Http\Controllers\V1\CompanyController::class, 'index'])->name('companies.index');
        Route::post('', [App\Http\Controllers\V1\CompanyController::class, 'store'])->name('companies.store');
        Route::get('{id}/detail', [App\Http\Controllers\V1\CompanyController::class, 'detail'])->name('companies.detail');
        Route::patch('{id}/detail', [App\Http\Controllers\V1\CompanyController::class, 'update'])->name('companies.update');
        Route::get('{id}/pdf', [App\Http\Controllers\V1\CompanyController::class, 'exportPDF'])->name('companies.exportPDF');

        Route::get('{id}/transaction', [App\Http\Controllers\V1\TransactionController::class, 'company'])->name('companies.transaction');
        Route::post('{id}/transaction', [App\Http\Controllers\V1\TransactionController::class, 'store'])->name('companies.transaction.store');

        Route::delete('{id}', [App\Http\Controllers\V1\CompanyController::class, 'destroy'])->name('companies.destroy');
    });

    Route::prefix('employees')->group(function () {
        Route::get('', [App\Http\Controllers\V1\EmployeeController::class, 'index'])->name('employee.index');
        Route::post('', [App\Http\Controllers\V1\EmployeeController::class, 'store'])->name('employee.store');
        Route::patch('', [App\Http\Controllers\V1\EmployeeController::class, 'importExcel'])->name('employee.importExcel');
        Route::get('{id}', [App\Http\Controllers\V1\EmployeeController::class, 'edit'])->name('employee.edit');
        Route::patch('{id}', [App\Http\Controllers\V1\EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('{id}', [App\Http\Controllers\V1\EmployeeController::class, 'destroy'])->name('employee.destroy');
    });

    Route::prefix('transactions')->group(function () {
        Route::get('', [App\Http\Controllers\V1\TransactionController::class, 'index'])->name('transaction.index');
    });
});
