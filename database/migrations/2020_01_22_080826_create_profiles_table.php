<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->string('avatar')->default('default.png');
            $table->integer('kiswahili')->default(0);
            $table->integer('english')->default(0);
            $table->integer('mathematics')->default(0);
            $table->integer('chemistry')->default(0);
            $table->integer('physics')->default(0);
            $table->integer('biology')->default(0);
            $table->integer('cre')->default(0);
            $table->integer('geography')->default(0);
            $table->integer('histroy')->default(0);
            $table->integer('agriculture')->default(0);
            $table->integer('business')->default(0);
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('profiles');
    }
}
