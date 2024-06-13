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
					<h4>${{ $employee->salary }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Vacation&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="month" class="form-control" name="vacation" value="{{ isset($employee) ? $employee->vacation->format('Y-m') : old('vacation') }}" />
				@else
					<h4>{{ $employee->vacation->format('Y-m') }}</h4>
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
				<label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
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
				<button type="submit" class="btn btn-primary mr-2">Apply Changes</button>
			@else
				<button type="submit" class="btn btn-primary mr-2">Save</button>
			@endisset
			<a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
		@else
			<a href="{{ route('employees.index') }}" class="btn btn-secondary">
			<span class="svg-icon svg-icon-primary svg-icon-2x">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
			    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			        <polygon points="0 0 24 0 24 24 0 24"/>
			        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"/>
			        <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "/>
			    </g>
				</svg>
			</span>Back</a>
		@endisset
	</div>
</form>