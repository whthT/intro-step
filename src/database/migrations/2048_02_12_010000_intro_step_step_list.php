<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntroStepStepList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intro_step_step_list', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->boolean("auth_only")->default(true);
            $table->string("view_path", 255);
            $table->text("step_info");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intro_step_step_list');
    }
}