<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job_title;

class AjaxController extends Controller {
   public function index(Request $request){
    	$jobs=Job_title::where('industry_id',$request->id)->get();
    	
        return view('socialmedia.newjobs',compact('jobs'));
   }
}