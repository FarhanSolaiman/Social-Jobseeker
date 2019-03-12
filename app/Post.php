<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps=true;

    function user() {
    	return $this->belongsTo('App\User');
    }
    
    function comment() {
    	return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    function like() {
        return $this->belongsToMany('App\User','likes');
    }
}
