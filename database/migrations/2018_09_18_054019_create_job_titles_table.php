<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTitlesTable extends Migration
{

    public function up()
    {
        Schema::create('job_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_title');
            $table->unsignedInteger('industry_id');

            $table->foreign('industry_id')
                ->references('id')
                ->on('industries');
        });
    }


    public function down()
    {
        Schema::dropIfExists('job_titles');
    }
}
