<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth')->group(function () {
    
    // Dashboard berdasarkan role
    Route::middleware('role:admin')->get('/dashboard.admin', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::middleware('role:kasir')->get('/dashboard.kasir', [DashboardController::class, 'kasirDashboard'])->name('dashboard.kasir');
    Route::middleware('role:pemilik')->get('/dashboard.pemilik', [DashboardController::class, 'pemilikDashboard'])->name('dashboard.pemilik');

     // Logout route
     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
    