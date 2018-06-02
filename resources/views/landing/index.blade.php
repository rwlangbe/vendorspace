@extends('templates.default')

@section('content')
	<div class="row col-lg-15">
		<div class="col-lg-3 top-margin left-column">
			<p>Quick links</p>
			<a href="{{ route('event.createevent') }}" class="btn btn-default">Create an event</a>
			<a href="{{ route('event.findevent') }}" class="btn btn-default">Find an event</a>
			<a href="{{ route('event.calendar') }}" class="btn btn-default">Calendar</a>
		</div>
		<div class="col-lg-9 top-margin windowed">
			<form role="form" action="{{ route('status.post') }}" method="post">
				<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
					<textarea placeholder="what's up {{ Auth::user()
						->getFirstNameOrUsername() }}?" name="status"
						class="form-control" rows="2"></textarea>
						@if ($errors->has('status'))
                     		<span class="help-block">{{ $errors->first('status') }}</span>
						@endif
				</div>				
				<button type="submit" class="btn btn-default">Update Status</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
			<hr>
			@if (!$statuses->count())
				<p>No statuses to list.</p>
			@else
				@foreach ($statuses as $status)
					@include('templates.partials.timeline')
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
						</div>
					</div>
				@endforeach
				{!! $statuses->render() !!}
			@endif
		</div>
	<div>
@stop