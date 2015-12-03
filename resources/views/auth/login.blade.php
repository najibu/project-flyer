@extends('layout')

@section('content')
	<div class="row">
        <div class="col-md-6 col-md-offset-3">
			<form method="POST" action="/auth/login">
				{!! csrf_field() !!}

				<div class="form-group">
					<label for="email" class="control-label">E-Mail Address</label>
					<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
				</div>

				<div class="form-group">
					<label for="password" class="control-label">Password</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>

				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember"> Remember Me
						</label>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Log in</button>
				</div>
			</form>

			@include('errors')
		</div>
    </div>
@stop