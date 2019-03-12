<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use File;

class PostController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('postpic')) {
            $post = new Post;
            $post->message = $request->post;
            $post->user_id = $request->user;
            $uniqueId= uniqid();

            $extension = $request->postpic->getClientOriginalExtension();
            $request->postpic->move('public/images/postimages/',$uniqueId.".$extension");
            $post->image = "public/images/postimages/".$uniqueId.".$extension";

            $post->save();
        } else {
            $post = new Post;
            $post->message = $request->post;
            $post->user_id = $request->user;
            $post->save();
        }

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        $post->message = $request->post;
        $post->save();

        return view('socialmedia.updatepost',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        File::delete($post->image);
        $post->delete();

        return redirect('home');
    }
}
