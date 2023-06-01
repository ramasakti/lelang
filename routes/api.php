<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Barang;

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

Route::get('/barang/get', [Barang::class, 'get']);
Route::post('/barang/store', [Barang::class, 'store']);
Route::get('/barang/detail/{id}', [Barang::class, 'detail']);
Route::put('/barang/update', [Barang::class, 'update']);
Route::delete('/barang/delete', [Barang::class, 'delete']);