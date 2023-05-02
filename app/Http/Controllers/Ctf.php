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
            ["title" => "Cryptographie", "desc" => "Vous venez d'intercepter un message secret de l'Empire : '77 72 66 68 76 66 67 62 61 63 72 65 72', comment le décoder ?", "hints" => ["Le message a été chiffré 2 fois !", "Essayez de changer la base !"]],
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
        if (is_null($initFlag) || $initFlag->flag_init === 0) {
            Flags::create([
                "user_id" => auth()->user()->id,
                "flag_init" => true
            ]);
            return redirect()->route("profile")->with("success", "Votre aventure commence maintenant, bonne chance !");
        }
        return redirect()->route("profile")->with("error", "Vous avez déjà initialisé votre aventure !");
    }

    protected function ctf_flag(Request $request, $flag) {
        $request->validate([
            "answer" => "required"
        ]);
        $datas = $request->all();
        $userFlags = Flags::where("user_id", auth()->user()->id)->first();
        if (is_null($userFlags)) {
            return redirect()->route("profile")->with("error", "Vous n'avez pas initialisé votre aventure !");
        }
        if ($userFlags->$flag === 1) {
            return redirect()->route("flags")->with("error", "Vous avez déjà validé ce flag !");
        }
        if ($datas["answer"] === env(strtoupper($flag))) {
            $userFlags->$flag = 1;
            $userFlags->save();
            return redirect()->route("flags")->with("success", "Bravo, vous avez validé le flag $flag !");
        }
        return redirect()->route("flags")->with("error", "Mauvaise réponse !");
    }
}
