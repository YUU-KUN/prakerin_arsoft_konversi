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

Route::post('createProduk', 'ProdukController@create');                 //Tambah Produk
Route::put('updateProduk/{id}', 'ProdukController@update');             //Update Produk
Route::put('tambahBerat/{id}', 'ProdukController@tambahBeratProduk');   //Tambah Berat Produk
Route::put('kurangBerat/{id}', 'ProdukController@kurangBeratProduk');   //Kurangi Berat Produk
Route::delete('hapusProduk/{id}', 'ProdukController@destroy');          //Hapus Produk Tertentu
Route::post('cariProduk/{limit}/{offset}', 'ProdukController@cariProduk');               //Cari Produk 
// Route::post('poin_siswa/{limit}/{offset}', 'ProdukController@findPoinSiswa'); //CARI PRODUK V2


// Route::get('getProduk', "ProdukController@index");                      //Read Produk
// Route::get('getProduk/{limit}/{offset}', "ProdukController@getAll");    //Read PRoduk


Route::get('getProduk/', 'ProdukController@getAll'); //Tampilkan Semua Produk v1
Route::get('getProduk/{id}', 'ProdukController@getProduk'); //Tampilkan Produk Tertentu v1

