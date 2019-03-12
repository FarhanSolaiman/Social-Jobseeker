@extends('layouts.template')

@section('title', 'SOCIAL-JOBSEEKER')


@section('externals')
	<!-- externals -->
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/css/datepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<!-- css for page -->
	<link rel="stylesheet" type="text/css" href="/css/front.css">
	<link rel="icon" type="image/png" href="/images/logo1.png">
@endsection

@section('content')

<div class="row m-0 contents">
	<div class="col-lg-3  px-3 pb-3 pt-2 sidenavi">
		<div class="col-lg-12 profileview mt-1">
			<h5 class="headings">PROFILE <button class="btn btn-sm btns" data-toggle="modal" data-target="#editmodal">EDIT</button></h5>
			<div class="row m-0 profuser">
				<div class="col-lg-4 profpic">
					<button class="btn btn-sm editpic" data-toggle="modal" data-target="#picturemodal"><i class="far fa-image"></i></button>
					<img src="{{Auth::user()->user_detail->image}}">
				</div>
				<div class="col-lg-8 profname p-0">
					<h5 class="headings m-0">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h5>
					@if(isset(Auth::user()->user_detail->job_titles->job_title))
					<h6>{{Auth::user()->user_detail->job_titles->job_title}}</h6>
					@else
					@endif
				</div>
			</div>
			<div class="col-lg-12 profdetails p-0 pb-3">
				<h6 class="my-2"><i class="fas fa-home"></i> &nbsp;&nbsp;{{Auth::user()->user_detail->address}}</h6>
				<h6 class="my-2"><i class="fas fa-birthday-cake"></i> &nbsp;&nbsp;{{Auth::user()->user_detail->birthday}}</h6>
				<h6 class="my-2"><i class="far fa-envelope"></i> &nbsp;&nbsp;{{Auth::user()->email}}</h6>
				@if(isset(Auth::user()->user_detail->resume))
				<h6 class="my-2 headings"><i class="far fa-file-alt"></i> &nbsp;&nbsp;<a href="{{Auth::user()->user_detail->resume}}" class="btn btn-sm btns" target="_blank" style="outline: none;">RESUME</a></h6>
				@else
				<h6 class="my-2 headings"><i class="far fa-file-alt"></i> &nbsp;&nbsp;<button disabled class="btn btn-sm btns" style="outline: none;">RESUME</button></h6>
				@endif

			</div>
		</div>
		<hr class="breaker my-0">
		<div class="col-lg-12 recentact mt-1">
			<h5 class="headings">Recent Activities</h5>
			<div class="activities">

				@foreach($recents as $recent)
				@if($recent->post_id == true)
				<p><a href="#">{{ucwords($recent->user->firstname)}} {{ucwords($recent->user->lastname)}}</a> commented on {{ucwords($recent->post->user->firstname)}} {{ucwords($recent->post->user->lastname)}}'s post {{Carbon\Carbon::parse($recent->created_at)->diffForHumans()}}.</p>
				@else
				<p><a href="#">{{ucwords($recent->user->firstname)}} {{ucwords($recent->user->lastname)}}</a> posted {{Carbon\Carbon::parse($recent->created_at)->diffForHumans()}}.</p>
				@endif
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-12 p-0 contentbox">
		<div class="bordered posting p-3">
			<h4 style="font-family: Roboto;font-weight: bold;">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h4>
			<form action="/post" method="POST" enctype="multipart/form-data">
				{{@csrf_field()}}
			<textarea type="text" class="form-control mx-3" name="post" id="posting" placeholder="What happened to your day?"></textarea>
			<input type="hidden" name="user" value="{{Auth::user()->id}}">
			<div class="custom-file btn btn-sm mt-2 ml-2 p-0" style="overflow: hidden; width: 34px; height: 34px;">
				<input type="file" accept="image/*" name="postpic" id="postpic" class="custom-file-input" style="width: 34px; height: 34px;">
	        	<label class="custom-file-label p-0 m-0 pb-1" for="inputpic" id="postlabel" style="width: 34px; height: 34px; border:none; background-color: #DDDDDD; display: flex; align-items: center; justify-content: center;"><i class="fas fa-camera"></i></label>
	        </div>
				<button type="button" id="postpicprev" data-toggle="modal" data-target="#picprevmodal" style="display: none;"></button>
			<button disabled class="btn btn-sm mt-2 ml-2"><i class="fas fa-location-arrow"></i></button>
			<button type="button" class="btn btn-sm float-right mt-2 mr-3 headings postsubmit">SUBMIT</button>
			</form>
		</div>
		<hr class="breaker my-1">
		<div class="postscont px-3 pt-3">
			<div class="bordered posts">
				@foreach($posts as $post)
				
				<div class="comments-container">
					<ul id="comments-list" class="comments-list">
						<li>
							<div class="comment-main-level">
								<!-- Avatar -->
								<div class="comment-avatar"><img src="{{$post->user->user_detail->image}}" alt=""></div>
								<!-- Contenedor del Comentario -->
								<div class="comment-box">
									<div class="comment-head">
										<input type="hidden" class="usererid" value="{{Auth::user()->id}}">
										<input type="hidden" class="posterid" value="{{$post->id}}">
										<h6 class="comment-name"><a href="#" style="color: #5773FC">{{$post->user->firstname}} {{$post->user->lastname}}</a></h6>
										<span>posted {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
										@if($post->user->id == Auth::user()->id)
										<span class="badge badge-danger float-right" id="badge{{$post->id}}" style="color: #636363; background-color: transparent;">{{ count($likes->where('post_id',$post->id)) }}</span>
										@if($likes->where('post_id',$post->id)->where('user_id',Auth::user()->id)->isNotEmpty())
										<i class="fa fa-heart liked" title="Unlike"></i>
										@else
										<i class="fa fa-heart unliked" title="Like"></i>
										@endif
										<form action="/{{$post->id}}/deletepost" method="POST" class="float-right" style="display: inline-block;">
											{{@csrf_field()}}
										<button type="submit" style="background-color: transparent; border: none; padding: 0;" title="Delete"><i class="fas fa-trash trash"></i></button>
										</form>
										<i class="fas fa-edit editpost" title="Edit"></i>
										<i class="fa fa-reply reply" title="Comment"></i>
										@else
										<span class="badge badge-danger float-right" id="badge{{$post->id}}" style="color: #636363; background-color: transparent;">{{ count($likes->where('post_id',$post->id)) }}</span>
										@if($likes->where('post_id',$post->id)->where('user_id',Auth::user()->id)->isNotEmpty())
										<i class="fa fa-heart liked" title="Unlike"></i>
										@else
										<i class="fa fa-heart unliked" title="Like"></i>
										@endif
										
										<i class="fa fa-reply reply" title="Comment"></i>
										@endif
									</div>
									<div class="comment-content contest{{$post->id}}">
										<div class="contentcommentshow">
											@if(isset($post->image))
												<img src="{{$post->image}}" class="mb-2">
											@else
											@endif
											@if(isset($post->message))
												<p>{!!nl2br(e($post->message))!!}</p>
											@else
											@endif
										</div>
										<div class="contentcommentedit" style="display: none">
											<input type="hidden" class="postid" value="{{$post->id}}">
											<textarea class="form-control" style="resize: none; font-size: 14px;" placeholder="{{$post->message}}"></textarea>
											<button class="btn btn-sm my-2 float-right dismiss">Dismiss</button><button class="btn btn-sm mr-2 my-2 float-right updatepost">Update</button>
										</div>
									</div>
								</div>
							</div>
							<!-- Respuestas de los comentarios -->
							<ul class="comments-list reply-list" id="comments{{$post->id}}">
								<li class="commenting" style="display: none;">
									<!-- Avatar -->
									<div class="comment-avatar"><img src="{{Auth::user()->user_detail->image}}" alt=""></div>
									<!-- Contenedor del Comentario -->
									<div class="comment-box">
										<div class="comment-head">
											<h6 class="comment-name"><a href="#">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a></h6>
										</div>
										<div class="comment-content">
											<input type="hidden" class="postid" value="{{$post->id}}">
											<input type="hidden" class="userid" value="{{Auth::user()->id}}">
											<textarea class="form-control" id="usercomment" style="resize: none; font-size: 14px;"></textarea>
											<button class="btn btn-sm my-2 float-right commentbtn">Send</button>
										</div>
									</div>
								</li>
								@foreach($post->comment as $comment)
								<li>
									<!-- Avatar -->
									<div class="comment-avatar"><img src="{{$comment->user->user_detail->image}}" alt=""></div>
									<!-- Contenedor del Comentario -->
									<div class="comment-box">
										<div class="comment-head">
											<input type="hidden" class="usererid" value="{{Auth::user()->id}}">
											<input type="hidden" class="commentingid" value="{{$comment->id}}">
											<h6 class="comment-name"><a href="#">{{$comment->user->firstname}} {{$comment->user->lastname}}</a></h6>
											<span>commented {{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
											@if($comment->user->id == Auth::user()->id)
											<span class="badge badge-danger float-right" id="badger{{$comment->id}}" style="color: #636363; background-color: transparent;">{{ count($likes->where('comment_id',$comment->id)) }}</span>
											@if($comment->liked->isNotEmpty())
											<i class="fa fa-heart liked" title="Unlike"></i>
											@else
											<i class="fa fa-heart unliked" title="Like"></i>
											@endif
											<form action="/{{$comment->id}}/deletecomment" method="POST" class="float-right" style="display: inline-block;">
												{{@csrf_field()}}
											<button type="submit" style="background-color: transparent; border: none; padding: 0;" title="Delete"><i class="fas fa-trash trash"></i></button>
											</form>
											<i class="fas fa-edit editcomment" title="Edit"></i>
											@else
											<span class="badge badge-danger float-right" id="badger{{$comment->id}}" style="color: #636363; background-color: transparent;">{{ count($likes->where('comment_id',$comment->id)) }}</span>
											@if($comment->liked->isNotEmpty())
											<i class="fa fa-heart liked" title="Unlike"></i>
											@else
											<i class="fa fa-heart unliked" title="Like"></i>
											@endif
											@endif
										</div>
										<div class="comment-content" id="commenter{{$comment->id}}">
											<div class="commentershow">
												@if(isset($comment->image))
													<img src="{{$comment->image}}" class="mb-2">
												@else
												@endif
												@if(isset($comment->message))
													<p>{!!nl2br(e($comment->message))!!}</p>
												@else
												@endif
											</div>
											<div class="commenteredit" style="display: none;">
												<input type="hidden" class="commentid" value="{{$comment->id}}">
											<textarea class="form-control" style="resize: none; font-size: 14px;" placeholder="{{$comment->message}}"></textarea>
											<button class="btn btn-sm my-2 float-right commentdismiss">Dismiss</button><button class="btn btn-sm mr-2 my-2 float-right updatecomment">Update</button>
											</div>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</li>
					</ul>
				</div>
				<br>
				@endforeach
				<a href='#' class='scroll-to-top'></a>
			</div>
		</div>
	</div>
	<div class="col-lg-3 px-3 pb-3 pt-2 friendtab">
		<div class="col-lg-12 recentjob mt-1">
			<h5 class="headings">Job Postings</h5>
			<div class="jobposts">
				@foreach($jobs as $job)
					<p><a href="#">{{$job->user->firstname}} {{$job->user->lastname}}</a> posted a job for the <a href="#">{{$job->industry->industry}}</a> Industry.</p>
				@endforeach
			</div>
		</div>
		<hr class="breaker my-0">
		<div class="col-lg-12 emailtab mt-1">
			<h5 class="headings">People</h5>
			<div class="friendscontainer">
				@foreach($friends as $friend)
				<div class="card mb-2" style="cursor: pointer;">
					<div class="card-body py-1 px-2 friend friend{{$friend->id}}" data-target="#message{{$friend->id}}" data-toggle="modal">
						<input type="hidden" value="{{$friend->id}}">
						<div class="row m-0 friendlist">
							<div class="col-lg-3 friendpic p-0">
								<img src="{{$friend->user_detail->image}}">
							</div>
							<div class="col-lg-9 frienddesc p-0 pt-1 pl-1">
								<h6 class="my-0">{{$friend->firstname}} {{$friend->lastname}}</h6>
								@if(isset($friend->user_detail->job_titles->job_title))
								<p class="friendsdesc">{{$friend->user_detail->job_titles->job_title}}</p>
								@else
								@endif
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

	<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title headings">EDIT PROFILE</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form method="post" action="/{{Auth::user()->id}}/updateuser" enctype="multipart/form-data">
	        	{{@csrf_field()}}
	        	<h6 class="headings">INDUSTRY</h6>
	        		<select class="custom-select" id="industry">
	        			@if(isset(Auth::user()->user_detail->job_titles->industry->id))
					    	<option selected read-only value="{{Auth::user()->user_detail->job_titles->industry->id}}">Choose...</option>
					    @else
					    	<option selected read-only value="">Choose...</option>
					    @endif
					    @foreach($industries as $industry)
					    <option value="{{ $industry->id }}">{{$industry->industry}}</option>
					    @endforeach
					</select>
	        	<h6 class="headings">JOB TITLE</h6>
	        		<select class="custom-select" name="job" id="job">
	        			@if(isset(Auth::user()->user_detail->job_titles->id))
					    <option selected read-only value="{{Auth::user()->user_detail->job_titles->id}}">Choose...</option>
					    @else
					    <option selected read-only value="">Choose...</option>
					    @endif
					</select>
	        	<h6 class="headings">ADDRESS</h6>
	        		@if(isset(Auth::user()->user_detail->address))
	        		<input type="text" name="address" class="form-control" value="{{Auth::user()->user_detail->address}}">
	        		@else
	        		<input type="text" name="address" class="form-control">
	        		@endif
	        	<h6 class="headings">BIRTHDAY</h6>
	        		@if(isset(Auth::user()->user_detail->birthday))
	        		<input id="date" name="birthday" type="text" readonly style="background-color: white" data-toggle="datepicker" class="form-control" value="{{Auth::user()->user_detail->birthday}}">
	        		@else
	        		<input id="date" name="birthday" type="text" readonly style="background-color: white" data-toggle="datepicker" class="form-control">
	        		@endif
	        	<h6 class="headings">LINK TO YOUR RESUME</h6>
	        		@if(isset(Auth::user()->user_detail->resume))
	        		<input type="text" name="resume" class="form-control" value="{{Auth::user()->user_detail->resume}}">
	        		@else
	        		<input type="text" name="resume" class="form-control">
	        		@endif
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
	        <button type="submit" class="btn btn-primary" id="save">Save changes</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="picturemodal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Upload Profile Picture</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body picform">
	        <div id="profpic">
	        	@if(isset(Auth::user()->image))
	        	<img id="profilepic" src="{{Auth::user()->image}}">
	        	@else
	        	<img id="profilepic" src="/images/default.jpg">
	        	@endif
	        </div>
	        <br>
	        <form method="POST" action="/{{Auth::user()->id}}/updateuser" enctype="multipart/form-data">
	        	{{@csrf_field()}}
	        <div class="custom-file" style="overflow: hidden;">
	        	<input type="hidden" name="job_id" value="{{Auth::user()->user_detail->job_id}}">
	        	<input type="hidden" name="address" value="{{Auth::user()->user_detail->address}}">
	        	<input type="hidden" name="birthday" value="{{Auth::user()->user_detail->birthday}}">
	        	<input type="hidden" name="resume" value="{{Auth::user()->user_detail->resume}}">
	        	<input type="file" accept="image/*" name="profpic" id="inputpic" class="custom-file-input">
	        	<label class="custom-file-label" for="inputpic" id="inputlabel">Choose image</label>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	@foreach($friends as $friend)
	<input type="hidden" id="recieving{{$friend->id}}" value="{{$friend->id}}">
	<div class="modal fade friendslist" id="message{{$friend->id}}" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Message {{$friend->firstname}} {{$friend->lastname}}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body messagebody" style="height: 400px; overflow-y: scroll; width: 100%;">
	      <div id="messages{{$friend->id}}">
	      @foreach($messages as $message)
	      @if($message->sender_id == Auth::user()->id && $message->receiver_id == $friend->id)
	        <div class="usermessage mb-2">
	        	<div class="usermesscont p-2">
	        		<h6>{{$message->send->firstname}} {{$message->send->lastname}}</h6>
	        		<p class="ml-3" style="word-break: break-word; font-size: 14px;">{!!nl2br(e($message->message))!!}</p>
	        	</div>
	        </div>
	      	@elseif($message->sender_id == $friend->id && $message->receiver_id == Auth::user()->id)
	        <div class="recipient mb-2">
	        	<div class="recmesscont p-2">
	        		<h6>{{$message->send->firstname}} {{$message->send->lastname}}</h6>
	        		<p class="ml-3" style="word-break: break-word; font-size: 14px;">{!!nl2br(e($message->message))!!}</p>
	        	</div>
	        </div>
	        @else
	        @endif
	      @endforeach
	        </div>
	      </div>
	      <div class="modal-footer" style="height: 100px; display: flex;">
	      		<input type="hidden" id="receiver" value="{{$friend->id}}">
	      		<input type="hidden" id="sender" value="{{Auth::user()->id}}">
	      		<textarea class="form-control" id="messaging{{$friend->id}}" style="resize: none;"></textarea>
	        	<button type="button" id="sentbtn" class="btn btn-sm btn-primary">Send</button>
	      </div>
	    </div>
	  </div>
	</div>
	@endforeach

    <div class="modal fade" id="picprevmodal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Post Picture Preview</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body picprevcont">
	        <img src="#" id="previewpic">
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="removepic" class="btn btn-danger" data-dismiss="modal">Remove</button>
	        <button type="button" id="okpic" class="btn btn-primary" data-dismiss="modal">Ok</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

@endsection

@section('script')
<script type="text/javascript" src="/js/datepicker.js"></script>
<script type="text/javascript">


//refresh posts and comments
<!--let url = '/posts';-->
 
<!--$(document).ready(function() {-->
 
<!--$.ajaxSetup({ cache: false }); -->
 
<!--setInterval(function() {$(".posts").load(url); }, 30000);-->
 
<!--});-->

<!--//refresh recents-->
<!--let url2 = '/recently';-->
 
<!--$(document).ready(function() {-->
 
<!--$.ajaxSetup({ cache: false }); -->
 
<!--setInterval(function() {$(".activities").load(url2); }, 30000);-->
 
<!--});-->

<!--//refresh messages-->

<!--$(document).on('click','.friend', function () {-->
<!--	let receiver_id = $(this).children('input').val();-->
<!--	let url = '/'+receiver_id+'/messaging';-->
	 
<!--	$(document).ready(function() {-->
	 
<!--	$.ajaxSetup({ cache: false }); -->
	 
<!--	setInterval(function() {$("#messages"+receiver_id).load(url); }, 1000);-->
	 
<!--	});-->
<!--});-->

$('#jobposts').click( () => {
	let base_url = 'https://social-jobseeker.000webhostapp.com/';
	window.location.href = base_url + "jobpost";
});

$('#postpage').click( () => {
	let base_url = 'https://social-jobseeker.000webhostapp.com/';
	window.location.href = base_url + "home";
});

function readURL2(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#previewpic').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#postpic").change(function() {
  readURL2(this);
  $('#postpicprev').click();
});

$("#removepic").click(function() {
  $('#postpic').val('');
});

	let searchBarInput = $("#searchBarInput");
let clearSearchBtn = $(".clearSearchBarField");

$(document).ready(function() {

	searchBarInput.keyup(function() {
		if( $(this).val().length === 0 ) {
			clearSearchBtn.hide()
		} else {
			clearSearchBtn.show()
		}
	});

	function resetInput() {
		clearSearchBtn.hide();
		searchBarInput.val('').focus();
	}


	function readURL(input) {

	  if (input.files && input.files[0]) {
		    let reader = new FileReader();

		    reader.onload = function(e) {
		      $('#profilepic').attr('src', e.target.result);
		    }

		    reader.readAsDataURL(input.files[0]);
		  }
		}

	$(document).on('click','.postsubmit', function() { 
		let posting = $('#posting').val();
		let postingpic = $('#postpic').val();
		if (posting.length == 0) {

		} else {
			$('.postsubmit').prop('type','submit');
		}
		if (postingpic.length == 0) {

		} else {
			$('.postsubmit').prop('type','submit');
		}
	});

	$('.posts').scroll(function() {
	  if ($(this).scrollTop() > 100) {
			$('.scroll-to-top').fadeIn();
		} else {
		  $('.scroll-to-top').fadeOut();
		}
	});

	$('#inputpic').change( function() {
		readURL(this);
		let fileNameIndex = $('#inputpic').val().lastIndexOf("/") + 13;
		let filename = $('#inputpic').val().substr(fileNameIndex);
		$('#inputlabel').html(filename);
	});

	$(document).on('click','.editpost', function() {
		$(this).parent().next().children('.contentcommentshow').fadeOut("fast", function() {
			$(this).parent().next().children('.contentcommentshow').hide();
		});
		$(this).parent().next().children('.contentcommentedit').delay(190).fadeIn("fast", function(){
			$(this).parent().next().children('.contentcommentedit').show();
		});
	});

	$(document).on('click','.dismiss', function() {
			$(this).parent().parent().children('.contentcommentshow').delay(190).fadeIn("fast", function() {	
			$(this).parent().siblings('.contentcommentshow').show();
		});

		$(this).parent('.contentcommentedit').fadeOut("fast", function() {
			$(this).parent('.contentcommentedit').hide();
		});
	});

	$(document).on('click','.editcomment', function() {
		$(this).parent().next().children('.commentershow').fadeOut("fast", function() {
			$(this).parent().next().children('.commentershow').hide();
		});
		$(this).parent().next().children('.commenteredit').delay(190).fadeIn("fast", function(){
			$(this).parent().next().children('.commenteredit').show();
		});
	});

	$(document).on('click','.commentdismiss', function() {
		$(this).parent().parent().children('.commentershow').delay(190).fadeIn("fast", function() {	
			$(this).parent().siblings('.commentershow').show();
		});

		$(this).parent('.commenteredit').fadeOut("fast", function() {
			$(this).parent('.commenteredit').hide();
		});
	});

	$(document).on('click','.updatecomment', function () {
		let message = $(this).siblings('textarea').val();
		let id = $(this).siblings('input').val();
		$.ajax({
			type:'POST',
			url:'/'+id+'/updatecomment',
			data:{
				comment:message
			},
			success:function(data){
				$('#commenter'+id).html(data);
			} 
		});
	});

	$('.scroll-to-top').on('click', function(e) {
	  e.preventDefault();
		$('.posts').animate({scrollTop : 0}, 800);
	});

	$(document).ready(function() {
		$('.logout').click( function() {
			$('#logout').slideToggle("fast");
		});
	});

	$(document).on('click','.reply', function() {
		$(this).parent().parent().parent().next().children('.commenting').slideToggle("slow");
	});

	$(document).on('click','.bellbtn', function() {
		$('.notificationtab').slideToggle("fast");
	});
	$(document).on('click','.bell', function() {
		$.ajax({
			type:'POST',
			url:'/notified',
			data:{},
			async:false,
			success:function(){
				$('.navbtn').removeClass('bell');
				$('#bellbdg').hide();
			}
		});
	});

	$('[data-toggle="datepicker"]').datepicker({
		format:'mm/yyyy',
		endDate: '12/2000'
	});

	$(document).on('click','.updatepost', function () {
		let message = $(this).siblings('textarea').val();
		let id = $(this).siblings('input').val();
		$.ajax({
			type:'POST',
			url:'/'+id+'/updatepost',
			data:{
				post:message
			},
			success:function(data){
				$('.contest'+id).html(data);
			}
		});
	});

	$(document).on('click','#sentbtn', function() {
		let sender_id = $(this).siblings('input#sender').val();
		let receiver_id = $(this).siblings('input#receiver').val();
		let message = $(this).siblings('textarea#messaging'+receiver_id).val();
		$.ajax({
			type:'POST',
			url:'/message',
			data:{
				sender_id:sender_id,
				receiver_id:receiver_id,
				message:message
			},
			async:false,
			success:function(data) {
				$('#messaging'+receiver_id).val('');
				$('#messages'+receiver_id).html(data);
			}
		});
	});

	$(document).on('click','.commentbtn', function () {
		let user_id = $(this).siblings('input.userid').val();
		let post_id = $(this).siblings('input.postid').val();
		let comment = $(this).siblings('textarea').val();
		$.ajax({
			type:'POST',
			url:'/'+post_id+'/comment',
			data:{
				user_id:user_id,
				comment:comment
			},
			async:false,
			success:function(data) {
				$('#comments'+post_id).html(data);

				$.ajax({
					type:'POST',
					url:'/updaterecent',
					data:{},
					async:false,
					success:function(datas) {
						$('.activities').html(datas);
					}
				});
			}
		});
	});

	$(document).on('change','#industry', () => {
		let pickind = $('#industry').val();
		$.ajax({
			type:'POST',
			url:'/industry',
			data:{
				id:pickind
			},
			success:function(data){
				// console.log(data);
				$('#job').html(data);
			}
		});
	});

	$(document).on('click','.unliked', function () {
		let post_id = $(this).parent().children('input.posterid').val();
		let comment_id = $(this).parent().children('input.commentingid').val();
		console.log($("#badger"+comment_id).html());
		let user_id = $(this).parent().children('input.usererid').val();
		let num = parseInt($("#badge"+post_id).html()) + 1;
		let nums = parseInt($("#badger"+comment_id).html()) + 1;

		$.ajax({
			type:'POST',
			url:'/liked',
			data:{
				post_id:post_id,
				comment_id:comment_id,
				user_id:user_id
			},
			async:false,
			success: () => {
				$(this).removeClass('unliked');
				$(this).addClass('liked');
				$(this).prop('title','Unlike');
				$("#badge"+post_id).html(num);
				$("#badger"+comment_id).html(nums);
			}
		});
	});

	$(document).on('click','.liked', function () {
		let post_id = $(this).parent().children('input.posterid').val();
		let comment_id = $(this).parent().children('input.commentingid').val();
		let user_id = $(this).parent().children('input.usererid').val();
		let num = parseInt($("#badge"+post_id).html()) - 1;
		let nums = parseInt($("#badger"+comment_id).html()) - 1;

		$.ajax({
			type:'POST',
			url:'/unliked',
			data:{
				post_id:post_id,
				comment_id:comment_id,
				user_id:user_id
			},
			async:false,
			success: () => {
				$(this).removeClass('liked');
				$(this).addClass('unliked');
				$(this).prop('title','Like');
				$("#badge"+post_id).html(num);
				$("#badger"+comment_id).html(nums);
			}
		});
	});

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
});
</script>

@endsection