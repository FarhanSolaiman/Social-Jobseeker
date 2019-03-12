<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;
use App\Post;
use App\Comment;
use App\User;
use App\Like;
use App\Message;
use App\Jobpost;
use App\Notification;
use Auth;
use Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = User::where('id','!=',Auth::user()->id)->get();
        $posts=Post::orderBy('created_at','desc')->get();
        $comments=Comment::orderBy('created_at','desc')->get();
        $notifications=Comment::orderBy('created_at','desc')->whereHas('post', function ($query) {
            $query->where('user_id',Auth::user()->id);
        })->where('notified',0)->limit(5)->get();
        $notificationsbdg=count(Comment::orderBy('created_at','desc')->whereHas('post', function ($query) {
            $query->where('user_id',Auth::user()->id);
        })->where('notified',0)->get());
        if ($notificationsbdg > 5) {
            $notificationsbdgr = '5+';
        } else {
            $notificationsbdgr = $notificationsbdg;
        }

        $industries=Industry::all();
        $likes=Like::all();
        $messages=Message::orderBy('created_at','desc')->get();
        $recents = $posts->merge($comments)->sortByDesc('created_at');
        $jobs = Jobpost::orderBy('created_at','desc')->get();

        return view('socialmedia.social',compact('recents','posts','industries','friends','likes','comments','notifications','notificationsbdgr','messages','jobs'));
    }

    public function update()
    {
        $comments = Comment::whereHas('post', function ($query) {
            $query->where('user_id',Auth::user()->id);
        })->get();
        foreach ($comments as $comment) {
        $comment->notified = 1;
        $comment->save();
        }

    }

    public function refresh() {
        $posts=Post::orderBy('created_at','desc')->get();
        $comments=Comment::orderBy('created_at','desc')->get();
        $likes=Like::all();
        
        return view('socialmedia.post',compact('posts','comments','likes'));
    }
 
}
