<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps=true;

    function send() {
    	return $this->belongsTo('App\User','sender_id');
    }

    function receive() {
    	return $this->belongsTo('App\User','receiver_id');
    }
}
