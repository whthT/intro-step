<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntroStepUserListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('intro_step_user_list', function (Blueprint $table){
            $table->increments("id");
            $table->unsignedInteger(config("intro-step.user_column"));
            $table->unsignedInteger("intro_step_step_list_id");

            $table->integer("last_step")->nullable();
            $table->timestamp("last_action")->nullable();

            $table->boolean("is_completed")->default(false);
            $table->timestamp("completed_at")->nullable();

            $table->timestamps();


            $table->foreign(config("intro-step.user_column"))->references("id")->on(config('intro-step.user_table'))->onDelete("CASCADE")->onUpdate("CASCADE");
            $table->foreign("intro_step_step_list_id")->references("id")->on("intro_step_step_list")->onDelete("CASCADE")->onUpdate("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intro_step_user_list');
    }
}