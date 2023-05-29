<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

use function PHPSTORM_META\map;

class PostController extends Controller
{
    public function index(Request $request) 
    {
        $token = $request->input("tokens");

        if(empty($token)) {
            return response()->json([
                "status" => 401,
                "message" => "Input tidak boleh kosong"
            ], 401);
        }

        $getData = User::where("tokens", $token)->first();
        $getAllPost = Post::all();
        if(isset($getData)) {
            if($getAllPost) {
                return response()->json([
                    "status" => 200,
                    "data" => $getAllPost
                ], 200);
            } else {
                return response()->json([
                    "status" => 401,
                    "message" => "Tidak ada post"
                ], 401);
            }
        } else {
            return response()->json([
                "status" => 401,
                "message" => "Token Invalid",
            ], 401);
        }
    }

    public function create(Request $request)
    {
        $tokens = $request->input("tokens");
        $getData = User::where("tokens", $tokens)->first();

        $judul = $request->input("judul");
        $isi = $request->input("isi");
        $slug = $request->input("slug");

        if(empty($judul) || empty($slug) || empty($isi)) {
            return response()->json([
                "status" => 401,
                "message" => "Input tidak boleh kosong"
            ]);
        }

        if(empty($tokens)) {
            return response()->json([
                "status" => 401,
                "message" => "Token tidak boleh kosong"
            ], 401);
        }

        if(isset($getData)) {
            $data = Post::create([
                "judul" => $judul,
                "isi" => $isi,
                "slug" => $slug
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Berhasil menambahkan data",
                "data" => $data
            ]);
        } else {
            return response()->json([
                "status" => 401,
                "message" => "Token Invalid",
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $tokens = $request->input("tokens");
        $getData = User::where("tokens", $tokens)->first();
        $post = Post::where("id", $id)->first();

        $judul = $request->input("judul");
        $isi = $request->input("isi");
        $slug = $request->input("slug");

        if(empty($judul) || empty($slug) || empty($isi)) {
            return response()->json([
                "status" => 401,
                "message" => "Input tidak boleh kosong"
            ]);
        }

        if(empty($tokens)) {
            return response()->json([
                "status" => 401,
                "message" => "Token tidak boleh kosong"
            ], 401);
        }

        if(isset($getData)) {
             $post->update([
                "judul" => $judul,
                "isi" => $isi,
                "slug" => $slug
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Berhasil mengubah data",
                "data" => $post
            ]);
        } else {
            return response()->json([
                "status" => 401,
                "message" => "Token Invalid",
            ], 401);
        }
    }

    public function getId(Request $request, $id)
    {
        $token = $request->input("tokens");
        $getData = User::where("tokens", $token)->first();
        $post = Post::where("id", $id)->first();

        if(empty($token)) {
            return response()->json([
                "status" => 401,
                "message" => "Input tidak boleh kosong"
            ]);
        }

        if(isset($getData)) {
            if($post) {
                return response()->json([
                    "status" => 200,
                    "message" => "Post ditemukan",
                    "data" => $post
                ]);
            } else {
                return response()->json([
                    "status" => 401,
                    "message" => "Post tidak ditemukan"
                ]);
            }
        } else {
            return response()->json([
                "status" => 401,
                "message" => "Token Invalid"
            ]);
        }
        
    }

    public function delete(Request $request, $id)
    {
        $token = $request->input("tokens");
        $getData = User::where("tokens", $token)->first();
        $post = Post::where("id", $id)->first();
        
        if(empty($token)) {
            return response()->json([
                "status" => 401,
                "message" => "Input tidak boleh kosong"
            ]);
        }

        if(isset($getData)) {
            $post->delete();
            return response()->json([
                "status" => 200,
                "message" => "Data berhasil dihapus"
            ]);
        } else {
            return response()->json([
                "status" => 401,
                "message" => "Invalid token"
            ]);
        }
    }

}
