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
}
