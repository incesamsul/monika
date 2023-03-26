<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\General;
use App\Http\Controllers\Home;
use App\Http\Controllers\Pegawai;
use App\Http\Controllers\Pejabat;
use App\Http\Controllers\Penilai;
use App\Http\Controllers\Sekretaris;
use App\Http\Controllers\UserController;

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



Route::post('/postlogin', [LoginController::class, 'postLogin']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/', [LoginController::class, 'login']);


Route::get('/tentang_aplikasi', [Home::class, 'tentangAplikasi']);


Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
});

// GENERAL CONTROLLER ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:Administrator,pejabat,sekretaris,pegawai,']], function () {

    Route::get('/dashboard', [General::class, 'dashboard']);
    Route::get('/profile', [General::class, 'profile']);
    Route::get('/bantuan', [General::class, 'bantuan']);

    Route::post('/ubah_foto_profile', [General::class, 'ubahFotoProfile']);
    Route::post('/ubah_role', [General::class, 'ubahRole']);
});

// PEGAWAI ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:pegawai']], function () {

    Route::group(['prefix' => 'pegawai'], function () {
        // GET REQUEST
        Route::get('/upload_berkas', [Pegawai::class, 'uploadBerkas']);
        Route::post('/create_upload_berkas', [Pegawai::class, 'createUploadBerkas']);
        Route::get('/tugas', [Pegawai::class, 'tugas']);
    });
});

// SEKRETARIS ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:sekretaris']], function () {

    Route::group(['prefix' => 'sekretaris'], function () {
        // GET REQUEST
        Route::get('/verifikasi_berkas', [Sekretaris::class, 'verifikasiBerkas']);
        Route::get('/verifikasi_berkas/{id_user}', [Sekretaris::class, 'verifikasiBerkas']);
        Route::get('/approve_berkas/{id_berkas}', [Sekretaris::class, 'approveBerkas']);
        Route::get('/pending_berkas/{id_berkas}', [Sekretaris::class, 'pendingBerkas']);
    });
});

// PEJABAT ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:pejabat']], function () {

    Route::group(['prefix' => 'pejabat'], function () {
        // GET REQUEST
        Route::get('/timeline', [Pejabat::class, 'timeline']);
        Route::get('/timeline/{id_user}', [Pejabat::class, 'timeline']);
    });
});


// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:Administrator']], function () {
    Route::group(['prefix' => 'admin'], function () {
        // GET REQUEST
        Route::get('/pengguna', [Admin::class, 'pengguna']);
        Route::get('/jabatan', [Admin::class, 'jabatan']);
        Route::get('/tugas', [Admin::class, 'tugas']);
        Route::get('/tugas/{id_jabatan}', [Admin::class, 'tugas']);
        Route::get('/fetch_data', [Admin::class, 'fetchData']);
        Route::get('/aktifkan_tugas/{id_tugas}', [Admin::class, 'aktifkanTugas']);
        Route::get('/matikan_tugas/{id_tugas}', [Admin::class, 'matikanTugas']);


        // CRUD JABATAN
        Route::post('/create_jabatan', [Admin::class, 'createJabatan']);
        Route::post('/update_jabatan', [Admin::class, 'updateJabatan']);
        Route::post('/delete_jabatan', [Admin::class, 'deleteJabatan']);

        // CRUD TUGAS
        Route::post('/create_tugas', [Admin::class, 'createTugas']);
        Route::post('/update_tugas', [Admin::class, 'updateTugas']);
        Route::post('/delete_tugas', [Admin::class, 'deleteTugas']);

        // CRUD PENGGUNA
        Route::post('/create_pengguna', [Admin::class, 'createPengguna']);
        Route::post('/update_pengguna', [Admin::class, 'updatePengguna']);
        Route::post('/delete_pengguna', [Admin::class, 'deletePengguna']);
    });
});
