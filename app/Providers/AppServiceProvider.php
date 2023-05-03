<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

// Custom models
use App\Models\Flags;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if("notInit", function() {
            $userFlags = Flags::where("user_id", auth()->user()->id)->first();
            return auth()->check() || is_null($userFlags) || $userFlags->flag_init === 0;
        });

        Blade::if("hasFlag", function($flag) {
            $flagName = Flags::reConvertFlag($flag);
            $hasFlag = Flags::where("user_id", auth()->user()->id)->first();
            return auth()->check() && $hasFlag->$flagName === 1;
        });

        Blade::if("finishAllFlags", function() {
            return auth()->check() && intval(FLags::countValues()) === 4;
        });
    }
}
