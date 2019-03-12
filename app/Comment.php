<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	
    public $timestamps=true;

    function user() {
    	return $this->belongsTo('App\User');
    }

    function post() {
    	return $this->belongsTo('App\Post');
    }

    function liked() {
        return $this->belongsToMany('App\User','likes');
    }

}
