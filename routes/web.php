<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SeniorCitizenController;
use App\Http\Controllers\IdApplicationController;
use App\Http\Controllers\PrintController;
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

// Dashboard pages 
Route::middleware('auth')->controller(DashboardController::class)->group(function () {
    Route::get('/id_applications', 'id_applications');
    Route::get('/pensions', 'pensions');
    Route::get('/reports', 'reports');
    Route::get('/users', 'users');
    Route::get('/settings', 'settings');

    // senior citizens
    Route::get('/citizens', 'citizens');
    Route::get('/citizens/delisted', 'delisted');
    Route::get('/citizens/add', 'register_citizen');
    Route::get('/citizens/{citizen}',  'view_citizen');
    Route::get('/citizens/{citizen}/edit', 'edit_citizen');

    // barangay
    Route::get('/barangays', 'barangays');
    Route::get('/barangays/{id}', 'view_barangay');
});


// senior citizen routes
Route::middleware('auth')->controller(SeniorCitizenController::class)->prefix('citizens')->group(function () {
    Route::post('/add/submit',  'store');
    Route::post('/{citizen}/delist',  'delist');
    Route::post('/{citizen}/recover', 'recover');
    Route::put('/{citizen}/update',  'update');
    Route::delete('/{citizen}/destroy', 'destory');
});

// barangay routes
Route::middleware('auth')->controller(BarangayController::class)->prefix('barangays')->group(function () {
    Route::post('/add', 'store');
    Route::put('/{barangay}/update', 'update');
    Route::delete('/{barangay}/destroy', 'destroy');
});


// User login/logout routes
Route::post('/user/authenticate', [UserController::class, 'authenticate']);
Route::post('/user/logout', [UserController::class, 'logout']);

// users page
Route::post('/users/add', [UserController::class, 'store'])->middleware('auth');
Route::post('/users/{user}/reset', [UserController::class, 'reset'])->middleware('auth');
Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->middleware('auth');

// ID application routes
Route::get('/id_applications/apply', [DashboardController::class, 'id_apply'])->middleware('auth');
Route::get('/id_applications/{application}', [DashboardController::class, 'view_id_application'])->middleware('auth');
Route::get('/id_applications/apply/{citizen}', [DashboardController::class, 'id_apply'])->middleware('auth');
Route::post('/id_applications/apply', [IdApplicationController::class, 'store'])->middleware('auth');
Route::post('/id_applications/apply/{citizen}', [IdApplicationController::class, 'store'])->middleware('auth');

// settings
Route::post('/settings/{user}/password_update', [UserController::class, 'password_update'])->middleware('auth');


// print
Route::middleware('auth')->controller(PrintController::class)->prefix('/print')->group(function () {
    Route::get('/citizens', 'citizens');
    Route::get('/citizen/{citizen}',  'citizen');
    Route::get('/barangays',  'barangays');
    Route::get('/barangay/{barangay}',  'barangay');
    Route::get('/id_application/{application}',  'id_application');
});
