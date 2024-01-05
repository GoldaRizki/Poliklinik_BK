<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\PoliController;
use App\Models\Periksa;

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

Route::get('/loginDokter', [DokterController::class, 'halamanLogin'])->middleware('guest:dokter');
Route::post('/dokterLogin', [DokterController::class, 'login'])->middleware('guest:dokter');
Route::post('/logoutDokter', [DokterController::class, 'logout'])->middleware('auth:dokter');

Route::get('/loginAdmin', [AdminController::class, 'halamanLogin'])->middleware('guest:admin');;
Route::post('/adminLogin', [AdminController::class, 'login'])->middleware('guest:admin');;
Route::post('/logoutAdmin', [AdminController::class, 'logout'])->middleware('auth:admin');

Route::get('/obat', [ObatController::class, 'index'])->middleware('auth:admin');
Route::post('/obat/create', [ObatController::class, 'create'])->middleware('auth:admin');
Route::get('/obat/edit/{id}', [ObatController::class, 'edit'])->middleware('auth:admin');
Route::put('/obat/update/', [ObatController::class, 'update'])->middleware('auth:admin');
Route::delete('/obat/delete/{id}', [ObatController::class, 'delete'])->middleware('auth:admin');


Route::get('/dokter', [DokterController::class, 'index'])->middleware('auth:admin');
Route::post('/dokter/create', [DokterController::class, 'create'])->middleware('auth:admin');
Route::get('/dokter/edit/{id}', [DokterController::class, 'edit'])->middleware('auth:admin');
Route::put('/dokter/update/', [DokterController::class, 'update'])->middleware('auth:admin');
Route::delete('/dokter/delete/{id}', [DokterController::class, 'delete'])->middleware('auth:admin');

Route::get('/poli', [PoliController::class, 'index'])->middleware('auth:admin');
Route::post('/poli/create', [PoliController::class, 'create'])->middleware('auth:admin');
Route::get('/poli/edit/{id}', [PoliController::class, 'edit'])->middleware('auth:admin');
Route::put('/poli/update/', [PoliController::class, 'update'])->middleware('auth:admin');
Route::delete('/poli/delete/{id}', [PoliController::class, 'delete'])->middleware('auth:admin');


Route::get('/daftarpoli', [PasienController::class, 'halamanDaftar']); // ojo dikei middleware, gawe pasien
Route::post('/pasien/daftar', [PasienController::class, 'daftar']);

Route::get('/pasien', [PasienController::class, 'index'])->middleware('auth:admin');
Route::post('/pasien/create', [PasienController::class, 'create'])->middleware('auth:admin');
Route::get('/pasien/edit/{id}', [PasienController::class, 'edit'])->middleware('auth:admin');
Route::put('/pasien/update', [PasienController::class, 'update'])->middleware('auth:admin');
Route::delete('/pasien/delete/{id}', [PasienController::class, 'delete'])->middleware('auth:admin');




Route::get('/inputJadwal', [JadwalController::class, 'index'])->middleware('auth:dokter');
Route::post('/jadwal/create', [JadwalController::class, 'create'])->middleware('auth:dokter');
Route::get('/jadwal/edit/{id}', [JadwalController::class, 'edit'])->middleware('auth:dokter');
Route::put('/jadwal/update', [JadwalController::class, 'update'])->middleware('auth:dokter');
Route::delete('/jadwal/delete/{id}', [JadwalController::class, 'delete'])->middleware('auth:dokter');


Route::post('/pasien/poli/daftar', [PeriksaController::class, 'daftarPoli']); // iki gawe pasien, ojo dikei middleware


Route::get('/antrian', [PeriksaController::class, 'antrian'])->middleware('auth:dokter');
Route::get('/pasien/periksa/{id}', [PeriksaController::class, 'periksa'])->middleware('auth:dokter');
Route::post('/pasien/periksa/', [PeriksaController::class, 'mulai_periksa'])->middleware('auth:dokter');
Route::delete('/pasien/daftar_poli/batal', [PeriksaController::class, 'batal_periksa'])->middleware('auth:dokter');
Route::post('/periksa', [PeriksaController::class, 'data_periksa'])->middleware('auth:dokter');
Route::post('/periksa/obat/tambah', [PeriksaController::class, 'tambah_obat'])->middleware('auth:dokter');
Route::delete('/periksa/obat/delete/{id}', [PeriksaController::class, 'hapus_obat'])->middleware('auth:dokter');

Route::post('/periksa/biaya', [PeriksaController::class, 'biaya_periksa'])->middleware('auth:dokter');


/*
Route::put('/jadwal/update', function(){
   ddd('oawkokawkawkawkawowkaoawk'); 
});
*/