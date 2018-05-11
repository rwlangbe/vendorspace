@extends('templates.default')

@section('content')
    <h3 class="top-margin80 left-margin titlemover">Sign in</h3>
	<div class="row main">
		<div class="col-lg-6">
			<form class="form-vertical" role="form" method="post" 
			action="{{ route('auth.signin') }}">
				<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					<label for="username" class="control-label">Username</label>
					<input type="text" name="username" class="form-control" id="username">
					@if ($errors->has('username'))
                        <span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="control-label">Password</label>
					<input type="password" name="password" class="form-control" id="password">
					@if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" id="remember" name="remember"> Remember me
					</label>
				</div>
				<div class="form-group">
					<button type="submit" name="login" class="btn btn-default">Sign in</button>
					<button type="submit" name="reset" class="btn btn-default">Forgot password</button>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>	
@stop