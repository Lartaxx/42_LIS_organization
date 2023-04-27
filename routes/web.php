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

Route::group(["prefix" => "auth"], function() {
    // Get routes
    Route::get("/{type}", [Auth::class, "auth_view"])->name("auth_view");

    // Post routes
    Route::post("/{type}", [Auth::class, "auth_post"])->name("auth_post");
});

Route::group(["prefix" => "ctf", "middleware" => "auth"], function() {
    // Get routes
    Route::get("/", [Ctf::class, "ctf_view"])->name("home")->middleware("flagInit");
    Route::get("/profile", [Ctf::class, "ctf_profile"])->name("profile");

    // Post routes
    Route::post("/", [Ctf::class, "ctf_post"])->name("ctf_post");
});