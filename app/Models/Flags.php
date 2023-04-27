<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
