<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained('animals');
            $table->foreignId('user_id')->constrained('users');
            $table->tinyInteger('sleep')->default(100)->comment('Sleep property, max 100 points');
            $table->tinyInteger('hunger')->default(100)->comment('Hunger property, max 100 points');
            $table->tinyInteger('care')->default(100)->comment('Care property, max 100 points');
            $table->boolean('alive')->default(1)->comment('Is animal alive?');
            $table->timestamp('sleep_increment_at')->default(now())->comment('Property updated timestamp');
            $table->timestamp('hunger_increment_at')->default(now())->comment('Property updated timestamp');
            $table->timestamp('care_increment_at')->default(now())->comment('Property updated timestamp');
            $table->timestamp('sleep_decrement_at')->default(now())->comment('Property updated timestamp');
            $table->timestamp('hunger_decrement_at')->default(now())->comment('Property updated timestamp');
            $table->timestamp('care_decrement_at')->default(now())->comment('Property updated timestamp');

            $table->unique(['animal_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_user');
    }
}
