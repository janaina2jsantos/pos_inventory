<form action="{{ isset($action) ? $action : '' }}" method="{{ isset($method) ? $method : '' }}" enctype="multipart/form-data">
	@csrf
	@isset($employee)
        {{ method_field('PUT') }}
    @endisset

	@if ($errors->any())
	    <div class="col-md-10 alert alert-danger col-errors">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	<div class="card-body">	
		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Name&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="name" value="{{ isset($employee) ? $employee->name : old('name') }}" placeholder="Full Name" />
				@else
					<h4>{{ $employee->name }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Email&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="email" class="form-control" name="email" value="{{ isset($employee) ? $employee->email : old('email') }}" placeholder="Email" />
				@else
					<h4>{{ $employee->email }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Phone&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="phone" id="phone" value="{{ isset($employee) ? $employee->phone : old('phone') }}" placeholder="Phone" />
				@else
					<h4>{{ $employee->phone }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>ZIP Code&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="zip" id="zip" value="{{ isset($employee) ? $employee->zip : old('zip') }}" placeholder="ZIP Code" />
				@else
					<h4>{{ $employee->zip }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Street&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="street" id="street" value="{{ isset($employee) ? $employee->address : old('street') }}" placeholder="Street" />
				@else
					<h4>{{ $employee->address }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Number&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="number" value="{{ isset($employee) ? $employee->number : old('number') }}" placeholder="Number" />
				@else
					<h4>{{ $employee->number }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Complement</label>
				@isset($action)
					<input type="text" class="form-control" name="complement" id="complement" value="{{ isset($employee) ? $employee->complement : old('complement') }}" placeholder="Complement" />
				@else
					<h4>{!! $employee->complement ?? '<small>Not provided</small>' !!}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Neighborhood&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="neighborhood" id="neighborhood" value="{{ isset($employee) ? $employee->neighborhood : old('neighborhood') }}" placeholder="Neighborhood" />
				@else
					<h4>{{ $employee->neighborhood }}</h4>
				@endisset
			</div>
		</div>	

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>City&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="city" id="city" value="{{ isset($employee) ? $employee->city : old('city') }}" placeholder="City" />
				@else
					<h4>{{ $employee->city }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>State/Region&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="state" id="state" value="{{ isset($employee) ? $employee->state : old('state') }}" placeholder="State" />
				@else
					<h4>{{ $employee->state }}</h4>
				@endisset
			</div>
		</div>
		<div class="divider"></div>	

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Role&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="role" value="{{ isset($employee) ? $employee->role : old('role') }}" placeholder="Role" />
				@else
					<h4>{{ $employee->role }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Experience&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<select class="form-control" name="experience">
						<option disabled="" {{ !isset($employee) ? 'selected' : '' }}>Select</option>
						<option value="1-2 years" {{ (isset($employee) && $employee->experience == '1-2 years') ? 'selected' : '' }}>1-2 years</option>
						<option value="2-3 years" {{ (isset($employee) && $employee->experience == '2-3 years') ? 'selected' : '' }}>2-3 years</option>
						<option value="3-4 years" {{ (isset($employee) && $employee->experience == '3-4 years') ? 'selected' : '' }}>3-4 years</option>
						<option value="4-5 years" {{ (isset($employee) && $employee->experience == '4-5 years') ? 'selected' : '' }}>4-5 years</option>
						<option value="5-6 years" {{ (isset($employee) && $employee->experience == '5-6 years') ? 'selected' : '' }}>5-6 years</option>
					</select>
				@else
					<h4>{{ $employee->experience }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>NID Number&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="nidno" placeholder="NID Number" value="{{ isset($employee) ? $employee->nid_no : old('nidno') }}" maxlength="8" onkeypress="validate(this, event);" />
				@else
					<h4>{{ $employee->nid_no }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Salary&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="salary" id="salary" value="{{ isset($employee) ? $employee->salary : old('salary') }}" placeholder="Salary" />
				@else
					<h4>${{ number_format($employee->salary, 2, ',', '.') }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Vacation&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="month" class="form-control" name="vacation" value="{{ isset($employee) ? $employee->vacation->format('Y-m') : old('vacation') }}" />
				@else
					<h4>{{ $employee->vacation->format('F, Y') }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">					
				<label>Status</label>
				@isset($action)
					<select class="form-control" name="status">
						<option value="1" {{ (!isset($employee) || isset($employee) && $employee->status == '1') ? 'selected' : '' }}>Active</option>
						<option value="0" {{ (isset($employee) && $employee->status == '0') ? 'selected' : '' }}>Inactive</option>
					</select>
				@else
					<h4>{{ $employee->status == 1 ? 'Active' : 'Inactive' }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">
			<div class="col-lg-9 col-xl-6">
				<label>Photo</label>
				@isset($action)
					<div class="col-lg-9 col-xl-6">
						<div class="image-input image-input-outline" id="kt_image_1">
							@isset($employee)
								<div class="image-input-wrapper" style="background-image: url({{ isset($employee->photo) ? asset($employee->photo) : asset('dist/assets/img/users/default_avatar.jpg') }});">
								</div>
							@else
								<div class="image-input-wrapper" style="background-image: url({{ asset('dist/assets/img/users/default_avatar.jpg') }})">
								</div>
					        @endisset
							<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
								<i class="fa-solid fa-pencil text-muted"></i>
								<input type="file" name="photo" accept=".png, .jpg, .jpeg" />
								<input type="hidden" name="photo_remove" />
							</label>
							<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
								<i class="fa-solid fa-xmark text-muted"></i>
							</span>
						</div>
						<span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
					</div>
				@else
					<div class="col-lg-9 col-xl-6">
						<div class="image-input image-input-outline" id="kt_image_1">
							<div class="image-input-wrapper" style="background-image: url({{ isset($employee->photo) ? asset($employee->photo) : asset('dist/assets/img/users/default_avatar.jpg') }});">
							</div>
						</div>
					</div>
				@endisset
			</div>
		</div>
	</div>

	<div class="card-footer">
		@isset($action)
			@isset($employee)
				<button type="submit" class="btn btn-primary mr-2">
				<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24"></rect>
						<circle fill="#000000" cx="9" cy="15" r="6"></circle>
						<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
					</g>
				</svg>
				</span>
				Apply Changes</button>
			@else
				<button type="submit" class="btn btn-primary mr-2">
				<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24"></rect>
						<circle fill="#000000" cx="9" cy="15" r="6"></circle>
						<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
					</g>
				</svg>
				</span>Save</button>
			@endisset
			<a href="{{ route('employees.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Cancel</a>
		@else
			<a href="{{ route('employees.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Back</a>
		@endisset
	</div>
</form>