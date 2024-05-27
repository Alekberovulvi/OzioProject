<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');


Route::group(['middleware'=> 'auth.admin', 'prefix'=> '/dashboard'],function() 
{
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::match(['get', 'post'], '/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
    Route::get('/customers/{userId}', [DashboardController::class, 'getCustomerDetails'])->name('dashboard.customer.details');
    Route::get('/receipts/{receiptId}', [DashboardController::class, 'getReceiptItems'])->name('dashboard.receipt.items');
});