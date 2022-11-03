<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SeniorCitizenController;
use App\Http\Controllers\SocialPensionController;
use App\Http\Controllers\PensionIntakeController;
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
Route::get("/", [UserController::class, "login"])->name("login")->middleware("guest");

// Dashboard pages
Route::middleware("auth")->controller(DashboardController::class)->group(function () {
    Route::get("/pensions", "pensions");
    Route::get("/reports", "reports");
    Route::get("/users", "users");
    Route::get("/settings", "settings");

    // senior citizens
    Route::get("/citizens", "citizens");
    Route::get("/citizens/delisted", "delisted");
    Route::get("/citizens/add", "register_citizen");
    Route::get("/citizens/{citizen}", "view_citizen");
    Route::get("/citizens/{citizen}/edit", "edit_citizen");

    // barangay
    Route::get("/barangays", "barangays");
    Route::get("/barangays/{barangay}", "view_barangay");

    // social pensions
    Route::get("/pensions/apply", "apply_pension");
    Route::get("/pensions/{pension}", "view_pension");

    // Pension intakes
    Route::get("/intakes", "intakes");
    Route::get("/intakes/register", "register_intake");

    // philthealth
    Route::get("/philhealth", "philhealth");
    Route::get("/philhealth/register", "register_philhealth");
    Route::get('/philhealth/view', 'view_philhealth');
});

// senior citizen routes
Route::middleware("auth")->controller(SeniorCitizenController::class)->prefix("citizens")->group(function () {
    Route::post("/add/submit", "store");
    Route::post("/{citizen}/delist", "delist");
    Route::post("/{citizen}/recover", "recover");
    Route::put("/{citizen}/update", "update");
    Route::delete("/{citizen}/destroy", "destory");
});

// barangay routes
Route::middleware("auth")->controller(BarangayController::class)->prefix("barangays")->group(function () {
    Route::post("/add", "store");
    Route::put("/{barangay}/update", "update");
    Route::delete("/{barangay}/destroy", "destroy");
});

// social pensions
Route::middleware("auth")->controller(SocialPensionController::class)->prefix("pensions")->group(function () {
    Route::post("/apply/submit", "store");
});

// pension intakes
Route::middleware("auth")->controller(PensionIntakeController::class)->prefix("intakes")->group(function () {
    Route::post("/register/submit", "store");
});

// philhealth 
Route::middleware('auth')->controller(PhilHealthController::class)->prefix('philhealth')->group(function () {
});

// User login/logout routes
Route::post("/user/authenticate", [UserController::class, "authenticate"]);
Route::post("/user/logout", [UserController::class, "logout"]);

// users page
Route::post("/users/add", [UserController::class, "store"])->middleware("auth");
Route::post("/users/{user}/reset", [UserController::class, "reset"])->middleware("auth");
Route::delete("/users/{user}/delete", [UserController::class, "destroy"])->middleware("auth");

// settings
Route::post("/settings/{user}/password_update", [UserController::class, "password_update",])->middleware("auth");

// print
Route::middleware("auth")->controller(PrintController::class)->prefix("/print")->group(function () {
    Route::get("/citizens", "citizens");
    Route::get("/citizen/{citizen}", "citizen");
    Route::get("/barangays", "barangays");
    Route::get("/barangay/{barangay}", "barangay");
});
