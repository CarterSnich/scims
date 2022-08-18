<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SeniorCitizenController;
use App\Http\Controllers\IdApplicationController;
use App\Http\Controllers\PrintController;

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
Route::get('/citizens', [DashboardController::class, 'citizens'])->middleware('auth');
Route::get('/citizens/delisted', [DashboardController::class, 'delisted'])->middleware('auth');
Route::get('/barangays', [DashboardController::class, 'barangays'])->middleware('auth');
Route::get('/id_applications', [DashboardController::class, 'id_applications'])->middleware('auth');
Route::get('/pensions', [DashboardController::class, 'pensions'])->middleware('auth');
Route::get('/reports', [DashboardController::class, 'reports'])->middleware('auth');
Route::get('/users', [DashboardController::class, 'users'])->middleware('auth');
Route::get('/settings', [DashboardController::class, 'settings'])->middleware('auth');


// Barangay pages //
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
Route::post('/citizens/{citizen}/delist', [SeniorCitizenController::class, 'delist'])->middleware('auth');
Route::post('/citizens/{citizen}/recover', [SeniorCitizenController::class, 'recover'])->middleware('auth');
Route::put('/citizens/{citizen}/update', [SeniorCitizenController::class, 'update'])->middleware('auth');

// ID application routes
Route::get('/id_applications/apply', [DashboardController::class, 'id_apply'])->middleware('auth');
Route::get('/id_applications/{application}', [DashboardController::class, 'view_id_application'])->middleware('auth');
Route::get('/id_applications/apply/{citizen}', [DashboardController::class, 'id_apply'])->middleware('auth');
Route::post('/id_applications/apply', [IdApplicationController::class, 'store'])->middleware('auth');
Route::post('/id_applications/apply/{citizen}', [IdApplicationController::class, 'store'])->middleware('auth');

// settings
Route::post('/settings/{user}/password_update', [UserController::class, 'password_update'])->middleware('auth');

// print
Route::get('/print/citizens', [PrintController::class, 'citizens'])->middleware('auth');
Route::get('/print/citizen/{citizen}', [PrintController::class, 'citizen'])->middleware('auth');
Route::get('/print/barangays', [PrintController::class, 'barangays'])->middleware('auth');
Route::get('/print/barangay/{barangay}', [PrintController::class, 'barangay'])->middleware('auth');
Route::get('/print/id_application/{application}', [PrintController::class, 'id_application'])->middleware('auth');
