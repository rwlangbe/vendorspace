@extends('templates.default')

@section('content')
	<div class="row main left-margin top-margin80">
		<div class="col-lg-5">
			@include('user.partials.userblock');
			<hr>
			@if (!$statuses->count())
				<p>{{ $user->getFirstNameOrUsername() }} has no posts to show.</p>
			@else
				@foreach ($statuses as $status)
					@include('templates.partials.timeline')
							@if ($authUserIsFriend || Auth::user()->id === $status->user->id)
								<form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" 
									method="post">
									<div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error' : '' }}">
										<textarea name="reply-{{ $status->id }}" class="form-control" rows="2"
										placeholder="Reply to this status"></textarea>
										@if ($errors->has("reply-{$status->id}"))
	                        				<span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
										@endif
									</div>
									<input type="submit" value="reply" class="btn btn-default btn-sm">
									<input type="hidden" name="_token" value="{{ Session::token() }}">
								</form>
							@endif
						</div>
					</div>
				@endforeach
			@endif
		</div>
		<div class="col-lg-4 col-lg-offset-3 top-margin">
			@if (Auth::user()->hasFriendRequestsPending($user))
				<p>Waiting for {{ $user->getNameOrUsername() }} to accept.</p>
			@elseif (Auth::user()->hasFriendRequestsReceived($user))
				<a href="{{ route('friend.accept', ['username' => $user->username]) }}" class="btn btn-primary">Accept Friendship</a>
			@elseif (Auth::user()->isFriendsWith($user))
				<p>You are friends with {{ $user->getNameOrUsername() }}. </p>
				<form action="{{ route('friend.delete', ['username' => $user->username]) }}" method="post">
					<input type="submit" value="Remove Friend" class="btn btn-primary">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">		
				</form>
			@elseif (Auth::user()->id !== $user->id)
				<a href="{{ route('friend.add', ['username' => $user->username]) }}" class="btn btn-primary">Send Friend Request</a>
			@endif

			<h4>{{ $user->getFirstNameOrUsername() }}'s friends.</h4>

			@if (!$user->friends()->count())
				<p>{{ $user->getFirstNameOrUsername() }}'s friends-list is empty.</p>
			@else
				@foreach ($user->friends() as $user)
					@include('user/partials/userBlock')
				@endforeach
			@endif
		</div>
	</div>
@stop
