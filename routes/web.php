<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;

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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/home', [DashboardController::class, 'index']);

Route::get('/loginDokter', [DokterController::class, 'halamanLogin']);
Route::post('/dokterLogin', [DokterController::class, 'login']);
Route::post('/logoutDokter', [DokterController::class, 'logout']);

Route::get('/loginAdmin', [AdminController::class, 'halamanLogin']);
Route::post('/adminLogin', [AdminController::class, 'login']);
Route::post('/logoutAdmin', [AdminController::class, 'logout']);

Route::get('/obat', [ObatController::class, 'index']);
Route::post('/obat/create', [ObatController::class, 'create']);
Route::get('/obat/edit/{id}', [ObatController::class, 'edit']);
Route::put('/obat/update/', [ObatController::class, 'update']);
Route::delete('/obat/delete/{id}', [ObatController::class, 'delete']);


Route::get('/dokter', [DokterController::class, 'index']);
Route::post('/dokter/create', [DokterController::class, 'create']);
Route::get('/dokter/edit/{id}', [DokterController::class, 'edit']);
Route::put('/dokter/update/', [DokterController::class, 'update']);
Route::delete('/dokter/delete/{id}', [DokterController::class, 'delete']);

Route::get('/poli', [PoliController::class, 'index']);
Route::post('/poli/create', [PoliController::class, 'create']);
Route::get('/poli/edit/{id}', [PoliController::class, 'edit']);
Route::put('/poli/update/', [PoliController::class, 'update']);
Route::delete('/poli/delete/{id}', [PoliController::class, 'delete']);


Route::get('/daftarpoli', [PasienController::class, 'halamanDaftar']);
Route::post('/pasien/daftar', [PasienController::class, 'daftar']);
