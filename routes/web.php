<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\dataMouController;

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
    return view('home');
});

Route::get('/tabel-informasi', function () {
    return view('content.tabelInformasi');
})->middleware('auth');

Route::get('/tabel-informasi', [dataMouController::class, 'index'])->middleware('auth');
Route::get('/data-edit/{id}', [dataMouController::class, 'edit'])->middleware('auth');

Route::post('/tambah-informasi', [dataMouController::class, 'store'])->middleware('auth');
Route::post('/update-informasi', [dataMouController::class, 'update'])->middleware('auth');
Route::delete('/hapus-informasi/{id}', [dataMouController::class, 'destroy'])->middleware('auth');


Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [loginController::class, 'logout'])->middleware('auth');
