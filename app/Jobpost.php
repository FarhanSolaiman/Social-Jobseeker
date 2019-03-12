<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    public $timestamps=true;

    function user() {
    	return $this->belongsTo('App\User');
    }

    function industry() {
    	return $this->belongsTo('App\Industry');
    }

    function job() {
    	return $this->belongsTo('App\Job_title');
    }
}
