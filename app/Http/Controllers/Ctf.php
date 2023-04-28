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

    protected function ctf_flags() {
        $modal = [
            ["title" => "Injection SQL", "desc" => "Injection SQL !"],
            ["title" => "Failles XSS", "desc" => "Failles XSS !"],
            ["title" => "Stéganographie", "desc" => "Stéganographie !"],
            ["title" => "Faille de l'invocateur", "desc" => "Faille de l'invocateur"],
        ];
        $initialScore = FLags::countValues();
        $score = FLags::countValues() / 4 * 100;
        return view('flags', ["modal" => $modal, "score" => $score, "initialScore" => $initialScore]);
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
