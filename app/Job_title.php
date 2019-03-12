<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_title extends Model
{
    public $timestamps=false;

    function industry() {
    	return $this->belongsTo('App\Industry');
    }

    function user_detail() {
    	return $this->hasMany('App\User_detail');
    }

        function jobpost() {
        return $this->hasMany('App\Jobpost');
    }
}
