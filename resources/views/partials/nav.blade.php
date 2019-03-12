<div class="navi">
	<div class="row m-0 navistrip">
		<!-- logo -->
		<div class="col-lg-3 col-12 logo">
			<img src="/images/logo1.png">
			<a href="/home" style="text-decoration: none;"><p id="logotext" class="mb-1 ml-3">SOCIAL-JOBSEEKER</p></a>
		</div>
		<!-- searchbar -->
		<div class="col-lg-5 search">
			<i class="fas fa-search searchBarSearchIcon noUserSelect"></i>
			<input type="text" name="header-search" value="" id="searchBarInput" placeholder="Search, discover, explore...">
			<i class="fas fa-times clearSearchBarField noUserSelect" onClick="resetInput()"></i>
		</div>
		<!-- navigation buttons -->
		<div class="col-lg-4 col-12 navibar">
					
			<div class="row" style="height: 100%">
				<div class="col-lg-2 col-2 navbtn bell bellbtn" title="Notifications">
					@if($notifications->isNotEmpty())
					<div class="notificationtab" style="display: none;">
						@foreach($notifications as $notification)
							<p style="font-size: 14px; text-align: center;">{{$notification->user->firstname}} {{$notification->user->lastname}} commented on your post.</p>
							<hr class="my-1">
						@endforeach
					</div>
					@else
					@endif
					<i class="far fa-bell"></i>
						@if($notificationsbdgr == 0)
						@else
						<span class="badge badge-danger" id="bellbdg">{{$notificationsbdgr}}</span>
						@endif
				</div>
				<div class="col-lg-2 col-2 navbtn" title="Friend Requests"><i class="fas fa-user-friends"></i></div>
				<div class="col-lg-2 col-2 navbtn" id="jobposts" title="Job Posts"><i class="fab fa-buysellads"></i></div>
				<div class="col-lg-4 col-4 navname" id="postpage" title="Home"><p class="m-0">HI {{strtoupper(Auth::user()->firstname)}}</p></div>
				<div class="col-lg-2 col-2 navbtn logout" title="Logout">
					<i class="far fa-user-circle" style="color: #5D503F;"></i>
					 <a  class="btn headings" id="logout" style="display: none; color: #5D503F;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    	{{@csrf_field()}}
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>