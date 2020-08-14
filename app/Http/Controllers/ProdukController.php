<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Produk;
use DB;

class ProdukController extends Controller
{   
    // INPUT PRODUK BARU
    public function create(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'nama_produk'   => 'required|string|max:25',
                'berat_produk'	=> 'required|numeric',
                'satuan_berat'	=> 'required|string',
            ]);
    
              if($validator->fails()){
                  return response()->json([
                      'status'	=> '0',
                      'message'	=> $validator->errors()
                  ]);
              }
              $data = new Produk();
              $data->nama_produk = $request->input('nama_produk');
              $data->berat_produk = $request->input('berat_produk');
              $data->satuan_berat = $request->input('satuan_berat');
              $data->save();

              return response()->json([
                  'status' => '1',
                  'message' => 'Produk '. $data->nama_produk . ' Berhasil Ditambahkan!'
              ], 201);

        } catch (\Exception $e){
            return response()->json([
                'status' => '0',
                'message' => $e->getMessage()
            ]);
        }
    }

    // MENGUPDATE PRODUK
    public function update(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'nama_produk'      => 'required|string|max:25',
                'berat_produk'	=> 'required|numeric',
                'satuan_berat'	=> 'required|string',
            ]);
    
              if($validator->fails()){
                  return response()->json([
                      'status'	=> '0',
                      'message'	=> $validator->errors()
                  ]);
              }

            //proses update data
            $data = Produk::where('id', $id)->first();
            $data->nama_produk = $request->input('nama_produk');
            $data->berat_produk = $request->input('berat_produk');
            $data->satuan_berat = $request->input('satuan_berat');
            $data->save();

            return response()->json([
                'status'	=> '1',
                'message'	=> 'Data Produk ' . $data->nama_produk . ' Berhasil Diupdate!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => '0',
                'message'	=> $e->getMessage()
            ]);
        }
    }

    // MENAMBAH BERAT PRODUK
    public function tambahBeratProduk(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'berat_tambah'	=> 'required|integer',
                'satuan_berat'	=> 'required|string',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status'	=> '0',
                    'message'	=> $validator->errors()
                ]);
            }

            $data = Produk::where('id', $id)->first();

            if ($request->input('satuan_berat') == $data->satuan_berat) {
                $data->berat_produk += $request->input('berat_tambah');
            } elseif ($data->satuan_berat == 'kg') {
                if ($request->input('satuan_berat') == 'ons') {
                    $data->berat_produk += $request->input('berat_tambah') / 10;
                } elseif ($request->input('satuan_berat') == 'gram'){
                    $data->berat_produk += $request->input('berat_tambah') / 1000;
                } elseif ($request->input('satuan_berat') == 'mg'){
                    $data->berat_produk += $request->input('berat_tambah') / 1000000;
                } else {
                    return response()->json([
                        'message' => 'Maaf, data konversi belum tersedia.'
                    ]);
                }
            } elseif ($data->satuan_berat == 'ons') {
                if ($request->input('satuan_berat') == 'kg') {
                    $data->berat_produk += $request->input('berat_tambah') * 10;
                } elseif ($request->input('satuan_berat') == 'gram'){
                    $data->berat_produk += $request->input('berat_tambah') / 100;
                } elseif ($request->input('satuan_berat') == 'mg'){
                    $data->berat_produk += $request->input('berat_tambah') / 100000;
                } else {
                    return response()->json([
                        'message' => 'Maaf, data konversi belum tersedia.'
                    ]);
                }
            } elseif ($data->satuan_berat == 'gram') {
                if ($request->input('satuan_berat') == 'kg') {
                    $data->berat_produk += $request->input('berat_tambah') * 1000;
                } elseif ($request->input('satuan_berat') == 'ons'){
                    $data->berat_produk += $request->input('berat_tambah') * 100;
                } elseif ($request->input('satuan_berat') == 'mg'){
                    $data->berat_produk += $request->input('berat_tambah') / 1000;
                } else {
                    return response()->json([
                        'message' => 'Maaf, data konversi belum tersedia.'
                    ]);
                }
            } elseif ($data->satuan_berat == 'mg') {
                if ($request->input('satuan_berat') == 'kg') {
                    $data->berat_produk += $request->input('berat_tambah') * 1000000;
                } elseif ($request->input('satuan_berat') == 'ons'){
                    $data->berat_produk += $request->input('berat_tambah') * 100000;
                } elseif ($request->input('satuan_berat') == 'gram'){
                    $data->berat_produk += $request->input('berat_tambah') * 1000;
                } else {
                    return response()->json([
                        'message' => 'Maaf, data konversi belum tersedia.'
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'Maaf, data konversi belum tersedia.'
                ]);
            }
            
            $data->save();

            return response()->json([
                'status'	=> '1',
                'message'	=> 'Berat Produk ' . $data->nama_produk . ' Berhasil Ditambahkan!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => '0',
                'message'	=> $e->getMessage()
            ]);
        }               
    }

    // MENGURANGI BERAT PRODUK
    public function kurangBeratProduk(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'berat_kurang'	=> 'required|integer',
                'satuan_berat'	=> 'required|string',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status'	=> '0',
                    'message'	=> $validator->errors()
                ]);
            }

            $data = Produk::where('id', $id)->first();
            if ($request->input('satuan_berat') == $data->satuan_berat) {
                $data->berat_produk -= $request->input('berat_kurang');
            } elseif ($data->satuan_berat == 'kg') {
                if ($request->input('satuan_berat') == 'ons') {
                    $data->berat_produk -= $request->input('berat_kurang') / 10;
                } elseif ($request->input('satuan_berat') == 'gram'){
                    $data->berat_produk -= $request->input('berat_kurang') / 1000;
                } elseif ($request->input('satuan_berat') == 'mg'){
                    $data->berat_produk -= $request->input('berat_kurang') / 1000000;
                } else {
                    return response()->json([
                        'message' => 'Maaf, data konversi belum tersedia.'
                    ]);
                }
            } elseif ($data->satuan_berat == 'ons') {
                if ($request->input('satuan_berat') == 'kg') {
                    $data->berat_produk -= $request->input('berat_kurang') * 10;
                } elseif ($request->input('satuan_berat') == 'gram'){
                    $data->berat_produk -= $request->input('berat_kurang') / 100;
                } elseif ($request->input('satuan_berat') == 'mg'){
                    $data->berat_produk -= $request->input('berat_kurang') / 100000;
                } else {
                    return response()->json([
                        'message' => 'Maaf, data konversi belum tersedia.'
                    ]);
                }
            } elseif ($data->satuan_berat == 'gram') {
                if ($request->input('satuan_berat') == 'kg') {
                    $data->berat_produk -= $request->input('berat_kurang') * 1000;
                } elseif ($request->input('satuan_berat') == 'ons'){
                    $data->berat_produk -= $request->input('berat_kurang') * 100;
                } elseif ($request->input('satuan_berat') == 'mg'){
                    $data->berat_produk -= $request->input('berat_kurang') / 1000;
                } else {
                    return response()->json([
                        'message' => 'Maaf, data konversi belum tersedia.'
                    ]);
                }
            } elseif ($data->satuan_berat == 'mg') {
                if ($request->input('satuan_berat') == 'kg') {
                    $data->berat_produk -= $request->input('berat_kurang') * 1000000;
                } elseif ($request->input('satuan_berat') == 'ons'){
                    $data->berat_produk -= $request->input('berat_kurang') * 100000;
                } elseif ($request->input('satuan_berat') == 'gram'){
                    $data->berat_produk -= $request->input('berat_kurang') * 1000;
                } else {
                    return response()->json([
                        'message' => 'Maaf, data konversi belum tersedia.'
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'Maaf, data konversi belum tersedia.'
                ]);
            }

            $data->save();

            return response()->json([
                'status'	=> '1',
                'message'	=> 'Berat Produk ' . $data->nama_produk . ' Berhasil Dikurangi!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => '0',
                'message'	=> $e->getMessage()
            ]);
        }
    }

    // MENGHAPUS PRODUK
    public function destroy($id){
        try{
            $delete = Produk::where("id", $id)->delete();
            if($delete){
              return response([
                "status"  => 1,
                  "message"   => "Data Produk berhasil dihapus."
              ]);
            } else {
              return response([
                "status"  => 0,
                  "message"   => "Data Produk gagal dihapus."
              ]);
            }
            
        } catch(\Exception $e){
            return response([
            	"status"	=> 0,
                "message"   => $e->getMessage()
            ]);
        }
    }

    //MENAMPILKAN SEMUA PRODUK
    public function index()
    {
    	try{
	        $data["count"] = Produk::count();
	        $produk = array();

	        foreach (Produk::all() as $p) {
	            $item = [
	                "id"                => $p->id,
	                "nama_produk"       => $p->nama_produk,
	                "berat_produk"      => $p->berat_produk,
	                "satuan_berat"      => $p->satuan_berat,
	                "created_at"        => $p->created_at,
	                "updated_at"        => $p->updated_at
	            ];

	            array_push($produk, $item);
	        }
	        $data["produk"] = $produk;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    // MENAMPILKAN PRODUK TERTENTU
    public function getAll($limit = 10, $offset = 0)
    {
    	try{
	        $data["count"] = Produk::count();
	        $produk = array();

	        foreach (Produk::take($limit)->skip($offset)->get() as $p) {
	            $item = [
	                "id"                => $p->id,
	                "nama_produk"       => $p->nama_produk,
	                "berat_produk"      => $p->berat_produk,
	                "satuan_berat"      => $p->satuan_berat,
	                "created_at"        => $p->created_at,
	                "updated_at"        => $p->updated_at
	            ];

	            array_push($produk, $item);
	        }
	        $data["produk"] = $produk;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function cariProduk(Request $request, $limit = 10, $offset = 0)
    {
        $find = $request->find;
        $dataProduk = DB::table('produks')->select('id', 
                                               			'nama_produk',
                                               			'berat_produk',
                                               			'satuan_berat')
                                               ->where('nama_produk', 'like', "%$find%");
                                            //    ->groupBy('id');

        $data["count"] = $dataProduk->get()->count();
        $produk = array();

        foreach ($dataProduk->get() as $p) {
            $item = [
                "id"          		=> $p->id,
                "nama_produk"  		=> $p->nama_produk,
                "berat_produk"  			=> $p->berat_produk,
                "satuan_berat"    	  		=> $p->satuan_berat,
            ];

            array_push($produk, $item);
        }
        $data["produk"] = $produk;
        $data["status"] = 1;
        return response($data);
    }

    // public function cariProduk(Request $request, $limit = 10, $offset = 0){
    //     $find = $request->find;
    //     $dataProduk = DB::table('produks')->select('id','nama_produk','berat_produk','satuan_berat')
    //                                         ->where('nama_produk', 'like', "%$find%");
    //                                         // ->groupBy('id','nama_produk','berat_produk','satuan_berat');
                                            
    //     $data["count"] = $dataProduk->get()->count();
    //     $produk = array();

    //     foreach ($dataProduk->get() as $p) {
    //         $item = [
    //             "id"          		=> $p->id,
    //             "nama_produk"  		=> $p->nama_produk,
    //             "berat_produk"  	=> $p->berat_produk,
    //             "satuan_berat"    	=> $p->satuan_berat,
    //         ];

    //         array_push($produk, $item);
        
    //     $data["produk"] = $produk;
    //     $data["status"] = 1;
    //     return response($data);
    // }

    // MY VER
    // public function getAll(){
    //     $data = Produk::all();
    //     return response($data);
    // }

    // public function getProduk($id){
    //     $data = Produk::where('id', $id)->get();
    //     return response($data);
    // }
}
