<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->string('resume')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('job_id')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('job_id')
                ->references('id')
                ->on('job_titles')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
