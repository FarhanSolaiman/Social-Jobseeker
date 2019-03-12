<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_detail;
use App\Http\Controllers\Controller;

class UserDetailController extends Controller
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->hasFile('profpic')) {

            $user = User_detail::where('user_id', $id)->first();
            $user->job_id = $request->job_id;
            $user->address = $request->address;
            $user->birthday = $request->birthday;
            $user->resume = $request->resume;
            $uniqueId= uniqid();

            $extension = $request->profpic->getClientOriginalExtension();
            $request->profpic->move('public/images/userimages/',$uniqueId.".$extension");
            $user->image = "public/images/userimages/".$uniqueId.".$extension";
            $user->save(); 
        } else {

            $user = User_detail::where('user_id', $id)->first();
            $user->job_id = $request->job;
            $user->address = $request->address;
            $user->birthday = $request->birthday;
            $user->resume = $request->resume;
        
            $user->save();
        }

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
