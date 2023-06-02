<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use DB;

class Lelang extends Controller
{
    public function get()
    {

    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->judul_lelang);
        $existingSlug = DB::table('lelang')->where('slug', $slug)->exists();

        if ($existingSlug) {
            $counter = 1;
            while ($existingSlug) {
                $newSlug = $slug . '-' . $counter;
                $existingSlug = DB::table('lelang')->where('slug', $newSlug)->exists();
                $counter++;
            }
            $slug = $newSlug;
        }

        $validator = Validator::make($request->all(), [
            'judul_lelang' => 'required',
            'kategori' => 'required',
            'mulai_lelang' => 'required|date',
            'selesai_lelang' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => 'Gagal menambahkan jadwal perlelangan!',
                'payload' => $validator->errors()
            ]);
        }

        DB::table('lelang')
            ->insert([
                'judul_lelang' => $request->judul_lelang,
                'kategori' => $request->kategori,
                'slug' => $slug,
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
