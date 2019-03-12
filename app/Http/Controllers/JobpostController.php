<?php

namespace App\Http\Controllers;

use App\Jobpost;
use App\Post;
use App\Comment;
use App\Industry;
use App\User;
use App\Message;
use Auth;
use File;
use Illuminate\Http\Request;

class JobpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = User::where('id','!=',Auth::user()->id)->get();
        $posts=Post::orderBy('created_at','desc')->get();
        $comments=Comment::orderBy('created_at','desc')->get();
        $messages=Message::orderBy('created_at','desc')->get();
        $industries=Industry::all();
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

        $jobs = Jobpost::orderBy('created_at','desc')->get();
        $recents = $posts->merge($comments)->sortByDesc('created_at');

        return view('jobposting.jobpost', compact('recents','friends','industries','messages','notifications','notificationsbdgr','jobs'));
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
        if($request->hasFile('jobimage')) {
            $job = new Jobpost;
            $job->message = $request->jobdescription;
            $job->user_id = Auth::user()->id;
            $job->industry_id = $request->industryid;
            $job->job_id = $request->jobid;
            $uniqueId= uniqid();

            $extension = $request->jobimage->getClientOriginalExtension();
            $request->jobimage->move('public/images/jobimages/',$uniqueId.".$extension");
            $job->image = "public/images/jobimages/".$uniqueId.".$extension";

            $job->save();
        } else {
            $job = new Jobpost;
            $job->message = $request->jobdescription;
            $job->user_id = Auth::user()->id;
            $job->industry_id = $request->industryid;
            $job->job_id = $request->jobid;
            $job->save();
        }

        return redirect('jobpost');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jobpost  $jobpost
     * @return \Illuminate\Http\Response
     */
    public function show(Jobpost $jobpost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jobpost  $jobpost
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobpost $jobpost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobpost  $jobpost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobpost $jobpost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jobpost  $jobpost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Jobpost::where('id', $id)->first();
        File::delete($job->image);
        $job->delete();

        return redirect('jobpost');
    }
}
