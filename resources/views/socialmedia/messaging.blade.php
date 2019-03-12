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
