<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SeniorCitizenController;
use App\Models\SeniorCitizen;

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

// index/login page
Route::get('/', [UserController::class, 'login'])->name('login')->middleware('guest');

// Dashboard pages //
Route::get('/barangays', [DashboardController::class, 'barangays'])->middleware('auth');
Route::get('/citizens', [DashboardController::class, 'citizens'])->middleware('auth');
Route::get('/pensions', [DashboardController::class, 'pensions'])->middleware('auth');
Route::get('/reports', [DashboardController::class, 'reports'])->middleware('auth');
Route::get('/users', [DashboardController::class, 'users'])->middleware('auth');
Route::get('/settings', [DashboardController::class, 'settings'])->middleware('auth');


// Barangay pages
Route::get('/barangays/{id}', [DashboardController::class, 'view_barangay'])->middleware('auth');

// citizen pages
Route::get('/citizens/add', [DashboardController::class, 'register_citizen'])->middleware('auth');
Route::get('/citizens/{id}', [DashboardController::class, 'view_citizen'])->middleware('auth');
Route::get('/citizens/{citizen}/edit', [DashboardController::class, 'edit_citizen'])->middleware('auth');

// User login/logout routes
Route::post('/user/authenticate', [UserController::class, 'authenticate']);
Route::post('/user/logout', [UserController::class, 'logout']);

// users page
Route::post('/users/add', [UserController::class, 'store'])->middleware('auth');
Route::post('/users/{user}/reset', [UserController::class, 'reset'])->middleware('auth');
Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->middleware('auth');

// Barangay routes
Route::post('/barangays/add', [BarangayController::class, 'store'])->middleware('auth');
Route::put('/barangays/{barangay}/update', [BarangayController::class, 'update'])->middleware('auth');
Route::delete('/barangays/{barangay}/destroy', [BarangayController::class, 'destroy'])->middleware('auth');

// Senior citizen routes
Route::post('/citizens/add', [SeniorCitizenController::class, 'store'])->middleware('auth');
Route::delete('/citizens/{citizen}/delete', [SeniorCitizenController::class, 'destroy'])->middleware('auth');
Route::put('/citizens/{citizen}/update', [SeniorCitizenController::class, 'update'])->middleware('auth');
Route::get('/citizens/{citizen}/print', [SeniorCitizenController::class, 'print'])->middleware('auth');

// settings
Route::post('/settings/{user}/password_update', [UserController::class, 'password_update'])->middleware('auth');
