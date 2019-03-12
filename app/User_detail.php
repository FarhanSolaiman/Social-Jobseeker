<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    public $timestamps=false;

    function user() {
    	return $this->hasOne('App\User');
    }

    function job_titles() {
    	return $this->belongsTo('App\Job_title','job_id');
    }

}
