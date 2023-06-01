<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

class Lelang extends Controller
{
    public function get()
    {

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mulai_lelang' => 'required|date',
            'selesai_lelang' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => 'Gagal menambahkan jadwal perlelangan!',
                'payload' => NULL
            ]);
        }

        DB::table('lelang')
            ->insert([
                'mulai_lelang' => $request->mulai_lelang,
                'selesai_lelang' => $request->selesai_lelang
            ]);

        return response()->json([
            'success' => TRUE,
            'message' => 'Berhasil menambahkan jadwal perlelangan!',
            'payload' => $request
        ]);
    }
}
