<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminFailedloginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_failedlogins', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
           
          $table->integer('failed_attempts')->default(1);
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
        Schema::dropIfExists('admin_failedlogins');
    }
}
