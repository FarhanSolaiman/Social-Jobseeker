<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'firstname','lastname', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    function user_detail() {
        return $this->hasOne('App\User_detail');
    }

    function jobpost() {
        return $this->hasMany('App\Jobpost');
    }

    function post() {
        return $this->hasMany('App\Post');
    }

    function comment() {
        return $this->hasMany('App\Comment');
    }

    function like() {
        return $this->belongsToMany('App\Post','posts');
    }

    function liked() {
        return $this->belongsToMany('App\Comment','comments');
    }

    function send() {
        return $this->belongsToMany('App\Send_message','send_messages');
    }

    function receive() {
        return $this->belongsToMany('App\Receive_message','receive_messages');
    }
}
