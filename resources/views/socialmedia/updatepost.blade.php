<div class="contentcommentshow">
	@if(isset($post->image))
		<img src="{{$post->image}}">
	@else
	@endif
	@if(isset($post->message))
		<p>{{$post->message}}</p>
	@else
	@endif
</div>
<div class="contentcommentedit" style="display: none">
	<input type="hidden" class="postid" value="{{$post->id}}">
	<textarea class="form-control" style="resize: none;" placeholder="{{$post->message}}"></textarea>
	<button class="btn btn-sm my-2 float-right dismiss">Dismiss</button><button class="btn btn-sm mr-2 my-2 float-right updatepost">Update</button>
</div>