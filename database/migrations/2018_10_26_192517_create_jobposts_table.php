<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobpostsTable extends Migration
{
    
    public function up()
    {
        Schema::create('jobposts', function (Blueprint $table) {
             $table->increments('id');
            $table->text('message');
            $table->string('image');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('industry_id');
            $table->unsignedInteger('job_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('industry_id')
                ->references('id')
                ->on('industries')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('job_id')
                ->references('id')
                ->on('job_titles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobposts');
    }
}
