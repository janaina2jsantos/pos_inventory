<form action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data">
	@csrf
	
	@isset($employee)
        {{method_field('PUT')}}
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
				<input type="text" name="name" class="form-control" value="{{ isset($employee) ? $employee->name : old('name') }}" placeholder="Full Name" />
			</div>
			<div class="col-md-6 form-group">
				<label>Email&nbsp;<span class="text-danger">*</span></label>
				<input type="email" name="email" class="form-control" value="{{ isset($employee) ? $employee->email : old('email') }}" placeholder="Email" />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Phone&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="phone" class="form-control" id="phone" value="{{ isset($employee) ? $employee->phone : old('phone') }}" placeholder="Phone" />
			</div>
			<div class="col-md-6 form-group">
				<label>ZIP Code&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="zip" class="form-control" id="zip" value="{{ isset($employee) ? $employee->zip : old('zip') }}" placeholder="ZIP Code" />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Street&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="street" class="form-control" id="street" value="{{ isset($employee) ? $employee->address : old('street') }}" placeholder="Street" />
			</div>
			<div class="col-md-6 form-group">
				<label>Number&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="number" class="form-control" value="{{ isset($employee) ? $employee->number : old('number') }}" placeholder="Number" />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Complement</label>
				<input type="text" name="complement" class="form-control" id="complement" value="{{ isset($employee) ? $employee->complement : old('complement') }}" placeholder="Complement" />
			</div>
			<div class="col-md-6 form-group">
				<label>Neighborhood&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="neighborhood" class="form-control" id="neighborhood" value="{{ isset($employee) ? $employee->neighborhood : old('neighborhood') }}" placeholder="Neighborhood" />
			</div>
		</div>	

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>City&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="city" class="form-control" id="city" value="{{ isset($employee) ? $employee->city : old('city') }}" placeholder="City" />
			</div>
			<div class="col-md-6 form-group">
				<label>State/Region&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="state" class="form-control" id="state" value="{{ isset($employee) ? $employee->state : old('state') }}" placeholder="State" />
			</div>
		</div>
		<div class="divider"></div>	

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Role&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="role" class="form-control" value="{{ isset($employee) ? $employee->role : old('role') }}" placeholder="Role" />
			</div>
			<div class="col-md-6 form-group">
				<label>Experience&nbsp;<span class="text-danger">*</span></label>
				<select class="form-control" name="experience">
					<option disabled="" {{ !isset($employee) ? 'selected' : '' }}>Select</option>
					<option value="1-2 years" {{ (isset($employee) && $employee->experience == '1-2 years') ? 'selected' : '' }}>1-2 years</option>
					<option value="2-3 years" {{ (isset($employee) && $employee->experience == '2-3 years') ? 'selected' : '' }}>2-3 years</option>
					<option value="3-4 years" {{ (isset($employee) && $employee->experience == '3-4 years') ? 'selected' : '' }}>3-4 years</option>
					<option value="4-5 years" {{ (isset($employee) && $employee->experience == '4-5 years') ? 'selected' : '' }}>4-5 years</option>
					<option value="5-6 years" {{ (isset($employee) && $employee->experience == '5-6 years') ? 'selected' : '' }}>5-6 years</option>
				</select>
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>NID Number&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="nidno" class="form-control" placeholder="NID Number" value="{{ isset($employee) ? $employee->nid_no : old('nidno') }}" maxlength="8" onkeypress="validate(this, event);" />
			</div>
			<div class="col-md-6 form-group">
				<label>Salary&nbsp;<span class="text-danger">*</span></label>
				<input type="text" name="salary" class="form-control" id="money" value="{{ isset($employee) ? $employee->salary : old('salary') }}" placeholder="Salary" />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Vacation&nbsp;<span class="text-danger">*</span></label>
				<input type="month" name="vacation" class="form-control" value="{{ isset($employee) ? $employee->vacation->format('Y-m') : old('vacation') }}" />
			</div>
			<div class="col-md-6 form-group">					
				<label>Status</label>
				<select class="form-control" name="status">
					<option value="1" {{ (!isset($employee) || isset($employee) && $employee->status == '1') ? 'selected' : '' }}>Active</option>
					<option value="0" {{ (isset($employee) && $employee->status == '0') ? 'selected' : '' }}>Inactive</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-9 col-xl-6">
				<label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
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
			</div>
		</div>
	</div>
	<div class="card-footer">
		@isset($employee)
			<button type="submit" class="btn btn-primary mr-2">Apply Changes</button>
		@else
			<button type="submit" class="btn btn-primary mr-2">Save</button>
		@endisset
		<a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
	</div>
</form>