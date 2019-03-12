<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    public $timestamps=false;

    function job_title() {
    	return $this->hasMany('App\Job_title');
    }

        function jobpost() {
        return $this->hasMany('App\Jobpost');
    }
}
