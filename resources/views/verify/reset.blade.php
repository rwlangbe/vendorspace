@extends('templates.default')

@section('content')
	<div class="top-margin80 left-margin">
	    <h3 class="titlemover left-margin">Recover Password</h3>
		<div class="row">
			<div class="col-lg-6">
				<form class="form-vertical" role="form" method="post" 
				action="{{ route('verify.reset') }}">
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email" class="control-label">Email</label>
						<input type="text" name="email" class="form-control" id="email">
						@if ($errors->has('email'))
	                        <span class="help-block">{{ $errors->first('email') }}</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
						<label for="username" class="control-label">Username</label>
						<input type="text" name="username" class="form-control" id="username">
						@if ($errors->has('username'))
	                        <span class="help-block">{{ $errors->first('username') }}</span>
						@endif
					</div>
					<div class="form-group">
						<button type="submit" name="login" class="btn btn-default">Send Email</button>
					</div>
					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</form>
			</div>
		</div>	
	</div>
@stop