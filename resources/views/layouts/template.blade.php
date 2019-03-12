<!DOCTYPE html>
<html lang="en">
<head>

	<!-- metas -->
	@include('partials.meta')
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- title -->
	<title>@yield('title')</title>

	{{-- external links --}}
	@yield('externals')

</head>
<body>
	<div class="container-fluid p-0">
	{{-- navbar --}}
		@include('partials.nav')

		{{-- contents --}}
		@yield('content')

		{{-- footer --}}
		@include('partials.footer')
	
	</div>
	{{-- scripts --}}
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
	@yield('script')

</body>
</html>