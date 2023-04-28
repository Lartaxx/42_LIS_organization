<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models
use App\Models\User;

class Auth extends Controller
{
    protected function auth_view($type) {
        switch ($type) {
            case "login": {
                return view('login');
                break;
            }

            case "register": {
                return view('register');
                break;
            }

            case "logout": {
                $auth = $this->auth_post_logout();
                if ($auth["error"] == false) {
                    return redirect()->route("auth_view", ["type" => "login"])->with("success", $auth["message"]);
                }
                return redirect()->route("home")->with("error", $auth["message"]);
                break;
            }
        }
    }

    protected function auth_post(Request $request, $type) {
        $request->validate([
            "login" => "required",
            "password" => "required",
            "conf-password" => "sometimes"
        ]);
        $datas = $request->all();

        switch ($type) {
            case "login": {
                $auth = $this->auth_post_login($datas);
                if ($auth["error"] == false) {
                    auth()->login($auth["user"]);
                    return redirect()->route("home")->with("success", "Bienvenue {$auth["user"]->login} !");
                }
                return redirect()->route("auth_view", ["type" => "login"])->with("error", $auth["message"]);
                break;
            }

            case "register": {
                $auth = $this->auth_post_register($datas);
                if ($auth["error"] == false) {
                    auth()->login($auth["user"]);
                    return redirect()->route("home")->with("success", "Votre compte a bien été créé !");
                }
                return redirect()->route("auth_view", ["type" => "login"])->with("error", $auth["message"]);
                break;
            }
        }
    }
    
    protected function auth_post_login($datas) {
        $user = User::where("login", $datas["login"])->first();
        if ($user) {
            if (password_verify($datas["password"], $user->password)) {
                return ["error" => false, "user" => $user];
            }
            return ["error" => true, "message" => "Mot de passe incorrect !"];
        }
        return ["error" => true, "message" => "Ce compte n'existe pas !"];
    }

    protected function auth_post_register($datas) {
       if ($datas["password"] === $datas["conf-password"]) {
        $user = User::where("login", $datas["login"])->first();
        if (!$user) {
            $newUser = User::create([
                "login" => $datas["login"],
                "password" => password_hash($datas["password"], PASSWORD_DEFAULT)
            ]);
            return ["error" => false, "user" => $newUser];
        }
        return ["error" => true, "message" => "Ce compte existe déjà !"];
       }
         return ["error" => true, "message" => "Les mots de passe ne correspondent pas !"];
    }

    protected function auth_post_logout() {
        try {
            session()->flush();
            auth()->logout();
            return ["error" => false, "message" => "À bientôt, héros de l'univers !"];
        } catch (\Throwable $th) {
            return ["error" => true, "message" => "Une erreur est survenue !"];
        }
    }
}
