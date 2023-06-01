<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Barang extends Controller
{
    public function get()
    {
        return response()->json([
            'status' => TRUE,
            'payload' => DB::table('barang')->get()
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'status' => TRUE,
            'message' => 'Berhasil menginput data!',
            'payload' => $request
        ]);
    }

    public function detail(Request $request, $id)
    {
        return response()->json([
            'status' => TRUE,
            'payload' => DB::table('barang')->where('id_barang', $id)->first()
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
            'message' => 'Berhasil delete data'
        ]);
    }
}
