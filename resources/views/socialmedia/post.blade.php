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