<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function doRegister(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");

        if(empty($name) || empty($password)) {
            return response()->json([
                "status" => 401,
                "message" => "Input tidak boleh kosong"
            ], 401);
        }

        // logic untuk register

        $validate = User::where("name", $name)->first();

        if($validate) {
            return response()->json([
                "status" => 401,
                "message" => "Akun sudah terdaftar"
            ], 401); 
        } else {
            $data = [
                "name" => $name,
                "password" => $password,
                "tokens" => Str::random(30)
            ];

            $insert = User::create($data);

            return response()->json([
                "status" => 200,
                "message" => "Berhasil register",
                "data" => $insert
            ]);
        }
    }

    public function doLogin(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");

        if(empty($name) || empty($password)) {
            return response()->json([
                "status" => 401,
                "message" => "Input tidak boleh kosong"
            ], 401);
        }

        $validate = User::where("name", $name)->first();

        if($validate) {
            if(Hash::check($password, $validate->password)) {
                $validate->update([
                    "tokens" => Str::random(30)
                ]);
    
                return response()->json([
                    "status" => 200,
                    "data" => $validate
                ], 200);
            } else {
                return response()->json([
                    "status" => 401,
                    "message" => "name atau password salah"
            ], 401);
            }
        } else {
            return response()->json([
                "status" => 401,
                "message" => "name atau password salah"
            ], 401);
        }

    }

}
