<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Barang;
use App\Http\Controllers\Lelang;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/barang/get', [Barang::class, 'get']);
Route::middleware('auth:sanctum')->post('/barang/store', [Barang::class, 'store']);
Route::middleware('auth:sanctum')->get('/barang/detail/{id}', [Barang::class, 'detail']);
Route::middleware('auth:sanctum')->put('/barang/update', [Barang::class, 'update']);
Route::middleware('auth:sanctum')->delete('/barang/delete', [Barang::class, 'delete']);

Route::middleware('auth:sanctum')->get('/lelang/get', [Lelang::class, 'get']);
Route::middleware('auth:sanctum')->post('/lelang/store', [Lelang::class, 'store']);
Route::middleware('auth:sanctum')->get('/lelang/detail/{id}', [Lelang::class, 'detail']);
Route::middleware('auth:sanctum')->put('/lelang/update', [Lelang::class, 'update']);
Route::middleware('auth:sanctum')->delete('/lelang/delete', [Lelang::class, 'delete']);