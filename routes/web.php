<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;

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


Route::get('/loginAdmin', [AdminController::class, 'halamanLogin']);
