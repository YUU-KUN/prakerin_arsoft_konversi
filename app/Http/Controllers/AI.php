<?php 

// $data->berat_produk += $request->input('berat_tambah'); --BERHASIL--

            // Implementasi AI

            // $data->berat_produk += $request->input('berat_tambah')  as BERAT_TAMBAH
            // $request->input('satuan_berat')  as SATUAN_BERAT
            
            // $data->satuan_berat              as SATUAN_DATABASE

//coba AI
// if (satuan berat persis yg di database) {
//     langsung tambah berat
// }elseif (satuan database kg) {
//     if (satuan berat = ons ){
//         berat tambah / 10
//     } elseif (satuan berat = gram){
//         berat tambah / 1000
//     } elseif (satuan berat = mg){
//         berat tambah / 1000000
//     } else {
//         keluar error
//     }
// } elseif (berat database ons){
//     if (satuan berat = kg) {
//         berat tambah * 10
//     } elseif (satuan berat = gram){
//         berat tambah / 100
//     } elseif (satuan berat = mg){
//         berat tambah / 100000
//     } else {
//         keluar error
//     }
// } elseif (berat database gram){
//     if (satuan berat = kg) {
//         berat tambah * 1000
//     } elseif (satuan berat = ons){
//         berat tambah * 100
//     } elseif (satuan berat = mg){
//         berat tambah / 1000
//     } else {
//         keluar error
//     }
// } elseif (berat database mg){
//     if (satuan berat = kg) {
//         berat tambah * 1000000
//     } elseif (satuan berat = ons){
//         berat tambah * 100000
//     } elseif (satuan berat = gram){
//         berat tambah * 1000
//     } else {
//         keluar error
//     }
// }

// ORIGINAL
            // if ($request->input('satuan_berat') == $data->satuan_berat) {
            //     $data->berat_produk += $request->input('berat_tambah');
            // } elseif ($request->input('satuan_berat') == 'kg') {
            //     $data->berat_produk += $request->input('berat_tambah');
            // } elseif ($request->input('satuan_berat') == 'ons') {
            //     $data->berat_produk += $request->input('berat_tambah')/10;
            // } elseif ($request->input('satuan_berat') == 'g') {
            //     $data->berat_produk += $request->input('berat_tambah')/1000;
            // } elseif ($request->input('satuan_berat') == 'mg') {
            //     $data->berat_produk += $request->input('berat_tambah')/1000000;
            //     // return $data->berat_produk;
            // } else {
            //     return response()->json([
            //         'message' => 'Maaf, data konversi belum tersedia.'
            //     ]);
            // }

            // public function getAll(){
    //     try{
	//         $data["count"] = Produk::count();
	//         $produk = array();

	//         foreach (Produk::all() as $p) {
	//             $item = [
	//                 "id"             => $p->id,
	//                 "nama_produk"    => $p->nama_produk,
	//                 "berat_produk"   => $p->berat_produk,
	//                 "satuan_berat"   => $p->satuan_berat,
	//                 // "created_at"  => $p->created_at,
	//                 // "updated_at"  => $p->updated_at
	//             ];

	//             array_push($produk, $item);
	//         }
	//         $data["produk"] = $produk;
	//         $data["status"] = 1;
    //         return response($data);

    //     } catch(\Exception $e){
	// 		return response()->json([
	// 		  'status' => '0',
	// 		  'message' => $e->getMessage()
	// 		]);
    //   	}

        // MY VER
        // $data = Produk::all();
        // return response($data);
    // }

    // public function getProduk($id){
    //     $data = Produk::where('id', $id)->get();
    //     return response($data);
    // }

?>