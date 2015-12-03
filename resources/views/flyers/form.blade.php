@inject('countries', 'App\Http\Utilities\Country')

{!! csrf_field() !!}
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="street">Street:</label>
			<input type="text" name="street" class="form-control" id="street" value="{{ old('street') }}" required>
		</div>

		<div class="form-group">
			<label for="city">City:</label>
			<input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}" required>
		</div>

		<div class="form-group">
			<label for="zip">Zip/Postal Code:</label>
			<input type="text" name="zip" class="form-control" id="zip" value="{{ old('zip') }}" required>
		</div>

		<div class="form-group">
			<label for="country">Country:</label>
			<select name="country" class="form-control" id="country">
				@foreach ($countries::all() as $country => $code)
					<option value="{{ $code }}">{{ $country }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="state">State:</label>
			<input type="text" name="state" class="form-control" id="state" value="{{ old('state') }}" required>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group">
			<label for="price">Sale Price:</label>
			<input type="text" name="price" class="form-control" id="price" value="{{ old('price') }}" required>
		</div>

		<div class="form-group">
			<label for="description">Home Description:</label>
			<textarea type="text" name="description" class="form-control" id="description" rows="10" >
				{{ old('description') }}
			</textarea>
		</div>

	</div>

	<div class="col-md-12">
		<hr>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Create Flyer</button>
		</div>
	</div>

</div>		