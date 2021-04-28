<?php

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


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
// Route::get('/', 'otentikasi\OtentikasiController@index')->name('indexLogin');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');
// Route::post('login', 'otentikasi\OtentikasiController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// // Route::group(['middleware' => 'CekLoginMiddleware'], function () {
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('index', ['isipesan' => 'Mantaps bos']);
    })->name('dashboard');
    Route::get('crud', 'CrudController@index')->name('crud');
    Route::get('crud/tambah', 'CrudController@tambah')->name('crtambah');
    Route::post('crud/simpan', 'CrudController@simpan')->name('crsimpan');
    Route::delete('crud/delete/{id}', 'CrudController@delete')->name('crdelete');
    Route::get('crud/{id}/edit', 'CrudController@edit')->name('credit');
    Route::patch('crud/{id}', 'CrudController@update')->name('crupdate');
    Route::resource('konfigurasi/setup', 'Konfigurasi\SetupController');
    Route::resource('master-data/divisi', 'MasterData\DivisiController');
    Route::resource('master-data/karyawan', 'MasterData\KaryawanController');
});

Route::get('/home', 'HomeController@index')->name('home');