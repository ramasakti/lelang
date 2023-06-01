<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

class Barang extends Controller
{
    public function get()
    {
        return response()->json([
            'status' => TRUE,
            'message' => 'Berhasil mendapatkan data barang!',
            'payload' => DB::table('barang')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatorBarang = Validator::make($request->all(), [
            'lelang_id' => 'required',
            'merk' => 'required',
            'jenis' => 'required',
            'warna' => 'required',
            'bahan_bakar' => 'required',
            'nomor_rangka' => 'required',
            'tahun' => 'required',
            'alamat' => 'required',
            'transmisi' => 'required',
            'kapasitas_mesin' => 'required',
            'odometer' => 'required',
            'nomor_mesin' => 'required',
            'gambar' => 'required',
            'harga' => 'required|integer',
        ]);

        if ($validatorBarang->fails()) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Gagal!',
                'payload' => $validatorBarang->errors()
            ]);
        }

        $validatorDokumen = Validator::make($request->all(), [
            'barang_id' => 'required',
            'nopol' => 'required|unique:dokumen_barang',
            'stnk' => 'required|boolean',
            'bpkb' => 'required',
            'ktp' => 'required|boolean',
            'form_a' => 'required|boolean',
            'keur' => 'required|boolean',
            'masa_stnk' => 'required|date',
            'faktur' => 'required|boolean',
            'kwitansi_blanko' => 'required|boolean',
            'sph' => 'required',
            'note' => 'required',
        ]);

        if ($validatorDokumen->fails()) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Gagal!',
                'payload' => $validatorDokumen->errors()
            ]);
        }

        DB::table('barang')
            ->insert([
                'lelang_id' => $request->lelang_id,
                'merk' => $request->merk,
                'jenis' => $request->jenis,
                'warna' => $request->warna,
                'bahan_bakar' => $request->bahan_bakar,
                'nomor_rangka' => $request->nomor_rangka,
                'tahun' => $request->tahun,
                'alamat' => $request->alamat,
                'transmisi' => $request->transmisi,
                'kapasitas_mesin' => $request->kapasitas_mesin,
                'odometer' => $request->odometer,
                'nomor_mesin' => $request->nomor_mesin,
                'gambar' => $request->gambar,
                'harga' => $request->harga,
            ]);

        return response()->json([
            'status' => TRUE,
            'message' => 'Berhasil menginput data!',
            'payload' => $request
        ]);
    }

    public function detail(Request $request, $id)
    {
        $detailBarang = DB::table('barang')
                            ->join('lelang', 'lelang.id_lelang', '=', 'barang.lelang_id')
                            ->join('dokumen_barang', 'dokumen_barang.barang_id', '=', 'barang.id_barang')
                            ->join('grade_barang', 'grade_barang.barang_id', '=', 'barang.id_barang')
                            ->where('barang.id_barang', $id)
                            ->first();

        return response()->json([
            'status' => TRUE,
            'message' => 'Berhasil mendapatkan detail data barang!',
            'payload' => $detailBarang
        ]);
    }

    public function update(Request $request)
    {
        return response()->json([
            'status' => TRUE,
            'message' => 'Berhasil mengupdate data!',
            'payload' => $request
        ]);
    }

    public function delete(Request $request, $id)
    {
        DB::table('barang')->where('id_barang', $id)->delete();
        return response()->json([
            'status' => TRUE,
            'message' => 'Berhasil delete data',
            'payload' => NULL
        ]);
    }
}
