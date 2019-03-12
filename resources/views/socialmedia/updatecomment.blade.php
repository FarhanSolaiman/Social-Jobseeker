<div class="commentershow">
	@if(isset($comment->image))
	<img src="{{$comment->image}}">
	@else
	@endif
	@if(isset($comment->message))
	<p>{{$comment->message}}</p>
	@else
	@endif
</div>
<div class="commenteredit" style="display: none;">
	<input type="hidden" class="commentid" value="{{$comment->id}}">
	<textarea class="form-control" style="resize: none; font-size: 14px;" placeholder="{{$comment->message}}"></textarea>
	<button class="btn btn-sm my-2 float-right commentdismiss">Dismiss</button><button class="btn btn-sm mr-2 my-2 float-right updatecomment">Update</button>
</div>