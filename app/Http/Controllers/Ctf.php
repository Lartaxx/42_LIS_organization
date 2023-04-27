<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models
use App\Models\Flags;

class Ctf extends Controller
{
    protected function ctf_view() {
        return view('home');
    }

    protected function ctf_profile() {
        return view('profile');
    }

    protected function ctf_post() {
        $initFlag = Flags::where("user_id", auth()->user()->id)->first();
        if (is_null($initFlag)) {
            Flags::create([
                "user_id" => auth()->user()->id,
                "flag_init" => true
            ]);
            return redirect()->route("profile")->with("success", "Votre aventure commence maintenan, bonne chance !");
        }
        return redirect()->route("profile")->with("error", "Vous avez déjà initialisé votre aventure !");
    }
}
