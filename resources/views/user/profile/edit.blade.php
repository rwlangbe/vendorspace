@extends('templates.default')

@section('content')
	<div class="top-margin80 left-margin">
		<h3 class="titlemover left-margin">Update your profile</h3>
		<div class="row">
			<h4>Personal Information</h4>
			<div class="col-lg-9">
				<form class="form-vertical" role="form" method="post" action="{{ route('profile.edit') }}">			
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">	
								<input type="text" name="first_name" class="form-control" id="first_name"
								placeholder="First name"
								value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">
								@if ($errors->has('first_name'))
	                        		<span class="help-block">{{ $errors->first('first_name') }}</span>
								@endif
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}" id="name_last">
								<input type="text" name="last_name" class="form-control" id="last_name"
								placeholder="Last name"
								value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">
								@if ($errors->has('last_name'))
	                        		<span class="help-block">{{ $errors->first('last_name') }}</span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
								<input type="text" name="city" class="form-control" id="city"
								placeholder="City"
								value="{{ Request::old('city') ?: Auth::user()->city }}">
								@if ($errors->has('city'))
			                        <span class="help-block">{{ $errors->first('city') }}</span>
								@endif
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
								<input type="text" name="state" class="form-control" id="state"
								placeholder="State"
								value="{{ Request::old('state') ?: Auth::user()->state }}">
								@if ($errors->has('state'))
			                        <span class="help-block">{{ $errors->first('state') }}</span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
								<label id="country" for="country" class="control-label">Country</label>
								<select name="country" class="form-control">
									<option selected value="{{ Request::old('country') ?: Auth::user()->country }}">
									{{ Request::old('country') ?: Auth::user()->country }}</option>	
									@include('templates.partials.countries')
								<select>
								@if ($errors->has('country'))
			                        <span class="help-block">{{ $errors->first('country') }}</span>
								@endif
							</div>
						</div>	
					</div>
					<div class="form-group">
						<button id="submit_update" type="submit" class="btn btn-default">Update Personal Information</button>
					</div>
					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<h4>Password Reset</h4>
			<div class="col-lg-9">
				<form class="form-vertical" role="form" method="post" action="{{ route('profile.edit') }}">
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
								<input type="password" name="oldpassword" class="form-control" id="oldpassword"
								placeholder="Old password"
								value="{{ Request::old('oldpassword') ?: Auth::user()->oldpassword }}">
								@if ($errors->has('oldpassword'))
	                        		<span class="help-block">{{ $errors->first('oldpassword') }}</span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
								<input type="password" name="newpassword" class="form-control" id="newpassword"
								placeholder="New password"
								value="{{ Request::old('newpassword') ?: Auth::user()->newpassword }}">
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
								placeholder="Confirm password"
								value="{{ Request::old('newpassword_confirmation') ?: Auth::user()->newpassword_confirmation }}">
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