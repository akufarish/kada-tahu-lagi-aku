<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route AUTH
Route::post("/auth/register", [AuthController::class, "doRegister"]);
Route::post("/auth/login", [AuthController::class, "doLogin"]);
Route::post("/post/auth/{tokens?}", [PostController::class, "logout"]);

// Route POST
Route::get("/post/all/{tokens?}", [PostController::class, "index"]);
Route::get("/post/{post:id}/{tokens?}", [PostController::class, "getId"]);
Route::post("/post/create/{tokens?}", [PostController::class, "create"]);
Route::post("/post/update/{post:id}/{tokens?}", [PostController::class, "update"]);
Route::post("/post/delete/{post:id}/{tokens?}", [PostController::class, "delete"]);
