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
            [
                "title" => "Cryptographie",
                "difficulty" => "Facile", 
                "desc" => "Vous venez d'intercepter un message secret de l'Empire : '77 72 66 68 76 66 67 62 61 63 72 65 72', comment le décoder ?",
                "hints" => [
                    "Le message a été chiffré 2 fois !", 
                    "Essayez de changer la base !"
                ]
            ],
            [
                "title" => "Rev",
                "difficulty" => "Facile", 
                "desc" => "Vous venez de trouver un fichier exécutable concu par les ingénieurs de l'Empire, il semble contenir un flag mais il manque le code source afin d'en extraire les informations. Comment les obtenirs ? <br> <a href='https://easyupload.io/3xni42'>yatilunflag</a>",
                "hints" => [
                    "Connaisez vous la commande 'strings' ?",
                    "L'utilisation de 'grep' pour trouver la bonne ligne pourrait vous aider !"
                ]
            ],
            [
                "title" => "WEB 1", 
                "difficulty" => "Moyenne",
                "desc" => "Voici un petit tutoriel sur les bases de hacking web..., visitez les dossiers du serveur pour obtenir le flag... <br> Lien : <a href='https://www.lostintheshell.fr/ctf-may4th/index.php' target='_blank'>CTF</a>",
                "hints" => [
                    "Un indice sur le nom du dossier que l'on cherche est caché dans l'image",
                    "Des sites comme CrackStation permettent de décoder certaines formes de cryptage"
                ]
            ],
            [
                "title" => "WEB 2",
                "difficulty" => "Moyenne",
                "desc" => "Répondez à cette question pour obtenir le FLAG : <br> Quelle est la couleur du vaisseau noir de Darth Vador ? <br> Lien : <a href='https://www.lostintheshell.fr/ctf-may4th/ctf-tutoN2.php' target='_blank'>CTF</a>",
                "hints" => [
                    "Un clic droit / inspect sur les couleurs pourrait aider..."
                ]
            ],
            [
                "title" => "WEB 3", 
                "difficulty" => "Moyenne",
                "desc" => "Faites vous passer pour un droid ou un android... et obtenez le FLAG ! <br> Lien : <a href='https://www.lostintheshell.fr/ctf-may4th/ctf-tutoN3.php' target='_blank'>CTF</a>",
                "hints" => [
                    "Essayez de faire croire au navigateur que vous êtes sur un appareil android !",
                    "Clic droit / inspect sur la page pourrait vous aider..."
                ]
            ],
            [
                "title" => "WEB 4",
                "difficulty" => "Difficile",
                "desc" => "Les cookies c'est bon, mangez-en !, mais attention à ne pas vous faire avoir... <br> Lien : <a href='https://www.lostintheshell.fr/ctf-may4th/ctf-tutoN4.php' target='_blank'>CTF</a>",
                "hints" => [
                    "Un cookie est un petit fichier stocké sur votre ordinateur, il peut être modifié !",
                    "Clic droit / inspect sur la page pourrait vous aider..."
                ]
            ],
        ];
        $initialScore = FLags::countValues();
        $score = FLags::countValues() / 6 * 100;
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
            $userFlags->updated_at = now();
            $userFlags->save();
            return redirect()->route("flags")->with("success", "Bravo, vous avez validé le flag $flag !");
        }
        return redirect()->route("flags")->with("error", "Mauvaise réponse !");
    }

    protected function ctf_leaderboard() {
        $flags = FLags::where("flag_one", 1)
                      ->where("flag_two", 1)
                      ->where("flag_three", 1)
                      ->where("flag_four", 1)
                      ->where("flag_five", 1)
                      ->where("flag_six", 1)
                      ->orderBy("updated_at", "ASC")
                      ->get();
        return view('leaderboard', ["flags" => $flags]);
    }
}
