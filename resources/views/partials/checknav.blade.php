<div class="vignette"></div>
<div class="navi">
	<div class="row m-0 navistrip">
		<!-- logo -->
		<div class="col-lg-3 col-12 logo">
			<img src="/images/logo1.png">
			<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none;"><p id="logotext" class="mb-1 ml-3">SOCIAL-JOBSEEKER</p></a>
	        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            @csrf
	        </form>
		</div>
	</div>
</div>