<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newusers', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('img');
            $table->tinyInteger('selected_image')->default('0');
            $table->string('address');
            $table->string('city');
            $table->string('contact_num');
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
        Schema::dropIfExists('newusers');
    }
}
