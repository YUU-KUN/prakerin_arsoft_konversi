<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('createProduk', 'ProdukController@create');
Route::post('createProduk', 'ProdukController@create'); //Tambah Produk
Route::put('updateProduk/{id}', 'ProdukController@update'); //Update Produk
Route::put('tambahBerat/{id}', 'ProdukController@tambahBeratProduk'); //Tambah Berat Produk
// Route::get('getProduk/', 'ProdukController@getAll'); //Tampilkan Semua Produk v1
// Route::get('getProduk/{id}', 'ProdukController@getProduk'); //Cari Produk Tertentu v1

Route::get('getProduk', "ProdukController@index"); //Read Produk
Route::get('getProduk/{limit}/{offset}', "ProdukController@getAll"); //Read PRoduk

Route::delete('hapusProduk/{id}', 'ProdukController@destroy'); //Hapus Produk Tertentu