<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\AuthController;


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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# Route Patients
# Authentication
Route::middleware(['auth:sanctum'])->group(function () {
    # tampilkan all resource
    Route::get('/patients', [PatientsController::class, 'index']);

    # tampilkan resource
    Route::get('/patients/{id}', [PatientsController::class, 'show']);

    # tambah resource
    Route::post('/patients', [PatientsController::class, 'store']);

    # edit resource
    Route::put('/patients/{id}', [PatientsController::class, 'update']);

    # hapus resource
    Route::delete('/patients/{id}', [PatientsController::class, 'destroy']);

    # cari resource by name
    Route::get('/patients/search/{name}', [PatientsController::class, 'search']);

    # tampilkan positive resource
    Route::get('/patients/status/{status}', [PatientsController::class, 'positive']);

    # tampilkan recovered resource
    Route::get('/patients/status/{status}', [PatientsController::class, 'recovered']);

    # tampilkan dead resource
    Route::get('/patients/status/{status}', [PatientsController::class, 'dead']);
});

# Route register & login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);