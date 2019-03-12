@foreach($recents as $recent)
@if($recent->post_id == true)
<p><a href="#">{{$recent->user->firstname}} {{$recent->user->lastname}}</a> commented to {{$recent->post->user->firstname}} {{$recent->post->user->lastname}}'s post {{Carbon\Carbon::parse($recent->created_at)->diffForHumans()}}.</p>
@else
<p><a href="#">{{$recent->user->firstname}} {{$recent->user->lastname}}</a> posted {{Carbon\Carbon::parse($recent->created_at)->diffForHumans()}}.</p>
@endif
@endforeach