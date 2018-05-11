@if (Session::has('info'))
	<div class="alert alert-info top-margin80" role="alert">
	    {{Session::get('info')}}
	</div>
@elseif (Session::has('success'))
	<div class="alert alert-info top-margin80" role="alert">
	    {{Session::get('success')}}
	</div>
@endif