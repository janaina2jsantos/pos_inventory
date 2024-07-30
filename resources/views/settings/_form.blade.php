<form action="{{ isset($action) ? $action : '' }}" method="{{ isset($method) ? $method : '' }}" enctype="multipart/form-data">
	@csrf
	@isset($setting)
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
				<input type="text" class="form-control" name="company_name" value="{{ isset($setting) ? $setting->company_name : old('company_name') }}" placeholder="Name" />
				
			</div>
			<div class="col-md-6 form-group">
				<label>Email&nbsp;<span class="text-danger">*</span></label>
				<input type="email" class="form-control" name="company_email" value="{{ isset($setting) ? $setting->company_email : old('company_email') }}" placeholder="Email" />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Phone&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="company_phone" id="phone" value="{{ isset($setting) ? $setting->company_phone : old('company_phone') }}" placeholder="Phone" />
			</div>
			<div class="col-md-6 form-group">
				<label>ZIP Code&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="company_zip" id="zip" value="{{ isset($setting) ? $setting->company_zip : old('company_zip') }}" placeholder="ZIP Code" />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Street&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="company_address" id="street" value="{{ isset($setting) ? $setting->company_address : old('company_address') }}" placeholder="Street" />
			</div>
			<div class="col-md-6 form-group">
				<label>Number&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="company_number" value="{{ isset($setting) ? $setting->company_number : old('company_number') }}" placeholder="Number" />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Complement</label>
				<input type="text" class="form-control" name="company_complement" id="complement" value="{{ isset($setting) ? $setting->company_complement : old('company_complement') }}" placeholder="Complement" />
			</div>
			<div class="col-md-6 form-group">
				<label>Neighborhood&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="company_neighborhood" id="neighborhood" value="{{ isset($setting) ? $setting->company_neighborhood : old('company_neighborhood') }}" placeholder="Neighborhood" />
			</div>
		</div>	

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>City&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="company_city" id="city" value="{{ isset($setting) ? $setting->company_city : old('company_city') }}" placeholder="City" />
			</div>
			<div class="col-md-6 form-group">
				<label>State/Region&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="company_state" id="state" value="{{ isset($setting) ? $setting->company_state : old('company_state') }}" placeholder="State" />
			</div>
		</div>

		<div class="row">
			<div class="col-lg-9 col-xl-6">
				<label>Logo</label>
				@isset($action)
					<div class="col-lg-9 col-xl-6">
						<div class="image-input image-input-outline" id="kt_image_1">
							@isset($setting)
								<div class="image-input-wrapper" style="background-image: url({{ isset($setting->company_logo) ? asset($setting->company_logo) : asset('dist/assets/img/misc/default_avatar.jpg') }});">
								</div>
							@else
								<div class="image-input-wrapper" style="background-image: url({{ asset('dist/assets/img/misc/default_avatar.jpg') }})">
								</div>
					        @endisset
							<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
								<i class="fa-solid fa-pencil text-muted"></i>
								<input type="file" name="company_logo" accept=".png, .jpg, .jpeg" />
								<input type="hidden" name="company_logo_remove" />
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
							<div class="image-input-wrapper" style="background-image: url({{ isset($setting->company_logo) ? asset($setting->company_logo) : asset('dist/assets/img/misc/default_avatar.jpg') }});">
							</div>
						</div>
					</div>
				@endisset
			</div>
		</div>
	</div>

	<div class="card-footer">
		@isset($setting)
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
		<a href="{{ route('dashboard.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Cancel</a>
	</div>
</form>