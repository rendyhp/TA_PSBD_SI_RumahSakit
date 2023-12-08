<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;

use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliklinikController;

use App\Http\Controllers\ObatController;
use App\Http\Controllers\RekammedisController;
use App\Http\Controllers\AuthController;

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

//data
Route::get('/', [AdminController::class, 'index'])->middleware('admin');
Route::get('/data_dokter', [AdminController::class, 'data_dokter'])->middleware('admin');
Route::get('/data_restore_dokter', [AdminController::class, 'data_restore_dokter'])->middleware('admin');
Route::get('/data_obat', [AdminController::class, 'data_obat'])->middleware('admin');
Route::get('/data_restore_obat', [AdminController::class, 'data_restore_obat'])->middleware('admin');
Route::get('/data_pasien', [AdminController::class, 'data_pasien'])->middleware('admin');
Route::get('/data_restore_pasien', [AdminController::class, 'data_restore_pasien'])->middleware('admin');
Route::get('/data_poliklinik', [AdminController::class, 'data_poliklinik'])->middleware('admin');
Route::get('/data_restore_poliklinik', [AdminController::class, 'data_restore_poliklinik'])->middleware('admin');
Route::get('/data_rekammedis', [AdminController::class, 'data_rekammedis'])->middleware('admin');
Route::get('/data_restore_rekammedis', [AdminController::class, 'data_restore_rekammedis'])->middleware('admin');


// Route::get('/obat_perlengkapan', [AdminController::class, 'obat_perlengkapan'])->middleware('admin');
// Route::get('/data_tindakan', [AdminController::class, 'data_tindakan'])->middleware('admin');



//CRUD dokter
Route::get('/tambah_dokter', [DokterController::class, 'tambah_dokter'])->middleware('admin');
Route::post('/restore_dokter', [DokterController::class, 'restore_dokter'])->middleware('admin');
Route::post('/store_dokter', [DokterController::class, 'store_dokter'])->middleware('admin');
Route::post('/hapus_dokter', [DokterController::class, 'hapus_dokter'])->middleware('admin');
Route::post('/hapus_dokter_permanen', [DokterController::class, 'hapus_dokter_permanen'])->middleware('admin');
Route::get('/edit_dokter/{id_dokter}', [DokterController::class, 'edit_dokter'])->middleware('admin');
Route::post('/update_dokter', [DokterController::class, 'update_dokter'])->middleware('admin');
Route::post('/cari_dokter', [DokterController::class, 'cari_dokter']);
Route::post('/cari_restore_dokter', [DokterController::class, 'cari_restore_dokter']);

//crud pasien
Route::get('/tambah_pasien', [PasienController::class, 'tambah_pasien'])->middleware('admin');
Route::post('/restore_pasien', [PasienController::class, 'restore_pasien'])->middleware('admin');
Route::post('/store_pasien', [PasienController::class, 'store_pasien'])->middleware('admin');
Route::post('/hapus_pasien', [PasienController::class, 'hapus_pasien'])->middleware('admin');
Route::post('/hapus_pasien_permanen', [PasienController::class, 'hapus_pasien_permanen'])->middleware('admin');
Route::get('/edit_pasien/{id}', [PasienController::class, 'edit_pasien'])->middleware('admin');
Route::post('/update_pasien', [PasienController::class, 'update_pasien'])->middleware('admin');
Route::post('/cari_pasien', [PasienController::class, 'cari_pasien']);
Route::post('/cari_restore_pasien', [PasienController::class, 'cari_restore_pasien']);

//crud poliklinik
Route::get('/tambah_poliklinik', [PoliklinikController::class, 'tambah_poliklinik'])->middleware('admin');
Route::post('/restore_poliklinik', [PoliklinikController::class, 'restore_poliklinik'])->middleware('admin');
Route::post('/store_poliklinik', [PoliklinikController::class, 'store_poliklinik'])->middleware('admin');
Route::get('/edit_poliklinik/{id}', [PoliklinikController::class, 'edit_poliklinik'])->middleware('admin');
Route::post('/hapus_poliklinik', [PoliklinikController::class, 'hapus_poliklinik'])->middleware('admin');
Route::post('/hapus_poliklinik_permanen', [PoliklinikController::class, 'hapus_poliklinik_permanen'])->middleware('admin');
Route::post('/update_poliklinik', [PoliklinikController::class, 'update_poliklinik'])->middleware('admin');
Route::post('/cari_poliklinik', [PoliklinikController::class, 'cari_poliklinik']);
Route::post('/cari_restore_poliklinik', [PoliklinikController::class, 'cari_restore_poliklinik']);

//crud Rekammedis
Route::get('/tambah_rekammedis', [RekammedisController::class, 'tambah_rekammedis'])->middleware('admin');
Route::post('/restore_rekammedis', [RekammedisController::class, 'restore_rekammedis'])->middleware('admin');
Route::post('/store_rekammedis', [RekammedisController::class, 'store_rekammedis'])->middleware('admin');
Route::get('/edit_rekammedis/{id}', [RekammedisController::class, 'edit_rekammedis'])->middleware('admin');
Route::post('/hapus_rekammedis', [RekammedisController::class, 'hapus_rekammedis'])->middleware('admin');
Route::post('/hapus_rekammedis_permanen', [RekammedisController::class, 'hapus_rekammedis_permanen'])->middleware('admin');
Route::post('/update_rekammedis', [RekammedisController::class, 'update_rekammedis'])->middleware('admin');
Route::post('/cari_rekammedis', [RekammedisController::class, 'cari_rekammedis']);
Route::post('/cari_restore_rekammedis', [RekammedisController::class, 'cari_restore_rekammedis']);


//crud obat
Route::get('/tambah_obat', [ObatController::class, 'tambah_obat'])->middleware('admin');
Route::post('/restore_obat', [ObatController::class, 'restore_obat'])->middleware('admin');
Route::post('/store_obat', [ObatController::class, 'store_obat'])->middleware('admin');
Route::post('/hapus_obat', [ObatController::class, 'hapus_obat'])->middleware('admin');
Route::post('/hapus_obat_permanen', [ObatController::class, 'hapus_obat_permanen'])->middleware('admin');
Route::get('/edit_obat/{id_dokter}', [ObatController::class, 'edit_obat'])->middleware('admin');
Route::post('/update_obat', [ObatController::class, 'update_obat'])->middleware('admin');
Route::post('/cari_obat', [ObatController::class, 'cari_obat']);
Route::post('/cari_restore_obat', [ObatController::class, 'cari_restore_obat']);

//crud tindakan
// Route::get('/tambah_tindakan', [TindakanController::class, 'tambah_tindakan'])->middleware('admin');
// Route::post('/store_tindakan', [TindakanController::class, 'store_tindakan'])->middleware('admin');
// Route::post('/hapus_tindakan', [TindakanController::class, 'hapus_tindakan'])->middleware('admin');
// Route::get('/edit_tindakan/{id}', [TindakanController::class, 'edit_tindakan'])->middleware('admin');
// Route::post('/update_tindakan', [TindakanController::class, 'update_tindakan'])->middleware('admin');
// Route::post('/cari_tindakan', [TindakanController::class, 'cari_tindakan']);


//autentikasi
Route::get('/register', [AuthController::class, 'register']);
Route::post('/store_register', [AuthController::class, 'store_register']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/store_login', [AuthController::class, 'store_login']);
Route::get('/logout', [AuthController::class, 'logout']);
