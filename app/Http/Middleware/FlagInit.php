<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Custom models
use App\Models\Flags;

class FlagInit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userFlags = Flags::where("user_id", auth()->user()->id)->first();
        if (is_null($userFlags)) {
            return $next($request);
        }
        else if (!is_null($userFlags) && $userFlags->flag_init === 0) {
            return $next($request);
        }
        return redirect()->route("profile")->with("error", "Vous avez déjà initialisé votre aventure !");

    }
}
