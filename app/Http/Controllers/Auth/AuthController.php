<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => 'Gagal!',
                'payload' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success = [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'name' => $user->name
        ];

        return response()->json([
            'success' => TRUE,
            'message' => 'Berhasil Register Akun!',
            'payload' => $success
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success = [
                'token' => $auth->createToken('auth_token')->plainTextToken,
                'email' => $auth->email,
                'name' => $auth->name
            ];

            return response()->json([
                'success' => TRUE,
                'message' => 'Berhasil Login!',
                'payload' => $success
            ]);
        }

        return response()->json([
            'success' => FALSE,
            'message' => 'Email atau password salah!',
            'payload' => NULL
        ]);
    }
}
