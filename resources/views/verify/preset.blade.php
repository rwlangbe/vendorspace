@extends('templates.default')

@section('content')
	<div class="top-margin80 left-margin">
		<h3 class="titlemover left-margin">Choose a new password.</h3>
		<div class="row">
			<h4>Password Reset</h4>
			<div class="col-lg-9">
				<form class="form-vertical" role="form" method="post" action="{{ route('verify.preset') }}">
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
								<input type="password" name="username" class="form-control" id="username"
								placeholder="Username">
								@if ($errors->has('username'))
	                        		<span class="help-block">{{ $errors->first('username') }}</span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
								<input type="password" name="newpassword" class="form-control" id="newpassword"
								placeholder="New password">
								@if ($errors->has('newpassword'))
			                        <span class="help-block">{{ $errors->first('newpassword') }}</span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group{{ $errors->has('newpassword_confirmation') ? ' has-error' : '' }}">
								<input type="password" name="newpassword_confirmation" class="form-control" id="newpassword_confirmation"
								placeholder="Confirm password">
								@if ($errors->has('newpassword_confirmation'))
			                        <span class="help-block">{{ $errors->first('newpassword_confirmation') }}</span>
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<button id="submit_update" type="submit" class="btn btn-default">Update Password</button>
					</div>
					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</form>
			</div>
		</div>
	</div>
@stop