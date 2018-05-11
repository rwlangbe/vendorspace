@extends('templates.default')

@section('content')
    <h3 class="top-margin80 left-margin titlemover">Sign up</h3>
    <div class="row main">
		<div class="col-lg-6">
			<form class="form-vertical" role="form" method="post" action="{{ route('auth.signup') }}">
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="control-label">Email Address</label>
					<input type="text" name="email" class="form-control" id="email" 
					value="{{ Request::old('email') ?: '' }}">
					@if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					<label for="username" class="control-label">Choose a username</label>
					<input type="text" name="username" class="form-control" id="username" 
					value="{{ Request::old('username') ?: '' }}">
				    @if ($errors->has('username'))
                        <span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
		 		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="control-label">Choose a password</label>
					<input type="password" name="password" class="form-control" id="password" value="">
				    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div> 
		 		<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					<label for="password_confirmation" class="control-label">Confirm password</label>
					<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" value="">
				    @if ($errors->has('password_confirmation'))
                        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
					@endif
				</div>		 
				<div class="form-group">
					<button type="submit" class="btn btn-default">Sign Up</buttun>
				</div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>

@stop