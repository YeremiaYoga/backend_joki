<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login',[AuthController::class,'login']);

Route::get('user/tampil', [UserController::class, 'tampil']);
Route::get('user/tampiluser/{id}', [UserController::class, 'tampiluser']);
Route::post('user/tambah', [UserController::class, 'tambah']);
Route::put('user/update/{id}', [UserController::class, 'update']);
Route::get('user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('tugas/tampil/{id}', [TugasController::class, 'tampil']);
Route::get('tugas/tampiltugas/{id}', [TugasController::class, 'tampiltugas']);
Route::post('tugas/tambah', [TugasController::class, 'tambah']);
Route::put('tugas/update/{id}', [TugasController::class, 'update']);
Route::get('tugas/hapus/{id}', [TugasController::class, 'hapus']);
Route::get('tugas/selesai/{id}', [TugasController::class, 'selesai']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout',[AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
