<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Flags extends Model
{
    use HasFactory;

    protected $table = "flags";

    protected $fillable = [
        "user_id",
        "flag_init",
        "flag_one",
        "flag_two",
        "flag_three",
        "flag_four"
    ];

    public static function countValues() {
        return self::where("user_id", auth()->user()->id)
        ->select(DB::raw("SUM(flag_one + flag_two + flag_three + flag_four) as total_flags"))
        ->first()
        ->total_flags;
    
    }

    public static function convertFlag($increment) {
        switch ($increment) {
            case "flag_one": {
                return 0;
                break;
            }

            case "flag_two": {
                return 1;
                break;
            }

            case "flag_three": {
                return 2;
                break;
            }

            case "flag_four": {
                return 3;
                break;
            }

            default: {
                return false;
                break;
            }
        }
    }

    public static function reConvertFlag($increment) {
        switch ($increment) {
            case 0: {
                return "flag_one";
                break;
            }

            case 1: {
                return "flag_two";
                break;
            }

            case 2: {
                return "flag_three";
                break;
            }

            case 3: {
                return "flag_four";
                break;
            }

            default: {
                return "flag_init";
                break;
            }
        }
    }
}
