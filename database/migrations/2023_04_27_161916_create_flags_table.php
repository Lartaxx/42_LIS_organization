<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->boolean("flag_init")->default(false);
            $table->boolean("flag_one")->default(false);
            $table->boolean("flag_two")->default(false);
            $table->boolean("flag_three")->default(false);
            $table->boolean("flag_four")->default(false);
            $table->boolean("flag_five")->default(false);
            $table->boolean("flag_six")->default(false);
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flags');
    }
};
