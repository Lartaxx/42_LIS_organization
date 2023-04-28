<?php

use Illuminate\Support\Facades\Route;

// Custom controllers
use App\Http\Controllers\Auth;
use App\Http\Controllers\Ctf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route("auth_view", ["type" => "login"]);
});

Route::group(["prefix" => "auth", "middleware" => "userAuth"], function() {
    // Get routes
    Route::get("/{type}", [Auth::class, "auth_view"])->name("auth_view");
    Route::get("/logout", [Auth::class, "auth_logout"])->name("auth_logout");

    // Post routes
    Route::post("/{type}", [Auth::class, "auth_post"])->name("auth_post");
});

Route::group(["prefix" => "ctf", "middleware" => "auth"], function() {
    // Get routes
    Route::get("/", [Ctf::class, "ctf_view"])->name("home")->middleware("flagInit");
    Route::get("/home", [Ctf::class, "ctf_profile"])->name("profile");
    Route::get("/flags", [Ctf::class, "ctf_flags"])->name("flags");

    // Post routes
    Route::post("/", [Ctf::class, "ctf_post"])->name("ctf_post")->middleware("flagInit");
    Route::post("/flag/{flag}", [Ctf::class, "ctf_flag"])->name("ctf_flag");
});