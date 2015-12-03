@extends('layout')

@section('content')
	<div class="row">
        <div class="col-md-6 col-md-offset-3">
			<h1>Register</h1>

			<hr>

			<form method="POST" action="/auth/register">
				{!! csrf_field() !!}
				
				<div class="form-group">
					<label for="name" class="control-label">Name:</label>
					<input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
				</div>

				<div class="form-group">
					<label for="email" class="control-label">E-Mail:</label>
					<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
				</div>

				<div class="form-group">
					<label for="password" class="control-label">Password:</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>

				<div class="form-group">
					<label for="password_confirmation" class="control-label">Confirm Password:</label>
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-default">Register</button>
				</div>
			</form>

			@include('errors')

		</div>
    </div>
@stop