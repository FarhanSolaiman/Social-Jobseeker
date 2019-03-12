<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Post;
use App\Like;
use App\Notification;
use Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $comment = new Comment;
        $comment->message = $request->comment;     
        $comment->post_id = $id;     
        $comment->user_id = $request->user_id;
        $comment->save();

        $post = Post::where('id', $id)->first();
        $allcomment = Comment::where('post_id',$id)->orderBy('updated_at','desc')->get();
        $likes = Like::all();


        return view('socialmedia.comments',compact('allcomment','post','likes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::where('id', $id)->first();
        $comment->message = $request->comment;
        $comment->save();

        return view('socialmedia.updatecomment',compact('comment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->first();
        $comment->delete();

        return redirect('home');
    }

    public function updaterecent()
    {
        $posts=Post::orderBy('created_at','desc')->get();
        $comments=Comment::orderBy('created_at','desc')->get();
        $recents = $posts->merge($comments)->sortByDesc('created_at');

        return view('socialmedia.updaterecent',compact('recents'));
    }
}
