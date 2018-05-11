@extends('templates.default')

@section('content')
	<div class="border">
		<div class="row main left-margin top-margin">
			<div class="col-lg-5">
				<h3>Friends List</h3>
				@if (!$friends->count())
					<p>friends list is empty.</p>
				@else
					@foreach ($friends as $user)
						@include('user/partials/userBlock')
					@endforeach
				@endif
			</div>
			<div class="col-lg-5">
				<h4 class="top-margin">Friend Request</h4>
				@if (!$requests->count())
					<p>Requests list is empty.</p>
				@else
					@foreach ($requests as $user)
						@include('user/partials/userBlock')
					@endforeach
				@endif			
			</div>
		</div>
	</div>
@stop