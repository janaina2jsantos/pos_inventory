<form action="{{ isset($action) ? $action : '' }}" method="{{ isset($method) ? $method : '' }}" enctype="multipart/form-data">
	@csrf
	@isset($customer)
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
					<input type="text" class="form-control" name="name" value="{{ isset($customer) ? $customer->name : old('name') }}" placeholder="Full Name" />
				@else
					<h4>{{ $customer->name }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Email&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="email" class="form-control" name="email" value="{{ isset($customer) ? $customer->email : old('email') }}" placeholder="Email" />
				@else
					<h4>{{ $customer->email }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Phone&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="phone" id="phone" value="{{ isset($customer) ? $customer->phone : old('phone') }}" placeholder="Phone" />
				@else
					<h4>{{ $customer->phone }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>ZIP Code&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="zip" id="zip" value="{{ isset($customer) ? $customer->zip : old('zip') }}" placeholder="ZIP Code" />
				@else
					<h4>{{ $customer->zip }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Street&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="street" id="street" value="{{ isset($customer) ? $customer->address : old('street') }}" placeholder="Street" />
				@else
					<h4>{{ $customer->address }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Number&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="number" value="{{ isset($customer) ? $customer->number : old('number') }}" placeholder="Number" />
				@else
					<h4>{{ $customer->number }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Complement</label>
				@isset($action)
					<input type="text" class="form-control" name="complement" id="complement" value="{{ isset($customer) ? $customer->complement : old('complement') }}" placeholder="Complement" />
				@else					
					<h4>{!! $customer->complement ?? '<small>Not provided</small>' !!}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Neighborhood&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="neighborhood" id="neighborhood" value="{{ isset($customer) ? $customer->neighborhood : old('neighborhood') }}" placeholder="Neighborhood" />
				@else
					<h4>{{ $customer->neighborhood }}</h4>
				@endisset
			</div>
		</div>	

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>City&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="city" id="city" value="{{ isset($customer) ? $customer->city : old('city') }}" placeholder="City" />
				@else
					<h4>{{ $customer->city }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>State/Region&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="state" id="state" value="{{ isset($customer) ? $customer->state : old('state') }}" placeholder="State" />
				@else
					<h4>{{ $customer->state }}</h4>
				@endisset
			</div>
		</div>
		<div class="divider"></div>	

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Shop Name&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="shop_name" value="{{ isset($customer) ? $customer->shop_name : old('shop_name') }}" placeholder="Role" />
				@else
					<h4>{{ $customer->shop_name }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Account Holder</label>
				@isset($action)
					<input type="text" class="form-control" name="account_holder" value="{{ isset($customer) ? $customer->account_holder : old('account_holder') }}" placeholder="Account Holder" />
				@else
					<h4>{!! $customer->account_holder ?? '<small>Not provided</small>' !!}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Account Number</label>
				@isset($action)
					<input type="text" class="form-control" name="account_number" placeholder="Account Number" value="{{ isset($customer) ? $customer->account_number : old('account_number') }}" onkeypress="validate(this, event);" />
				@else
					<h4>{!! $customer->account_number ?? '<small>Not provided</small>' !!}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Bank Name</label>
				@isset($action)
					<input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="{{ isset($customer) ? $customer->bank_name : old('bank_name') }}" />
				@else
					<h4>{!! $customer->bank_name ?? '<small>Not provided</small>' !!}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Bank Branch</label>
				@isset($action)
					<input type="text" class="form-control" name="bank_branch" placeholder="Bank Branch" value="{{ isset($customer) ? $customer->bank_branch : old('bank_branch') }}" />
				@else
					<h4>{!! $customer->bank_branch ?? '<small>Not provided</small>' !!}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">					
				<label>Status</label>
				@isset($action)
					<select class="form-control" name="status">
						<option value="1" {{ (!isset($customer) || isset($customer) && $customer->status == '1') ? 'selected' : '' }}>Active</option>
						<option value="0" {{ (isset($customer) && $customer->status == '0') ? 'selected' : '' }}>Inactive</option>
					</select>
				@else
					<h4>{{ $customer->status == 1 ? 'Active' : 'Inactive' }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">
			<div class="col-lg-9 col-xl-6">
				<label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
				@isset($action)
					<div class="col-lg-9 col-xl-6">
						<div class="image-input image-input-outline" id="kt_image_1">
							@isset($customer)
								<div class="image-input-wrapper" style="background-image: url({{ isset($customer->photo) ? asset($customer->photo) : asset('dist/assets/img/users/default_avatar.jpg') }});">
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
							<div class="image-input-wrapper" style="background-image: url({{ isset($customer->photo) ? asset($customer->photo) : asset('dist/assets/img/users/default_avatar.jpg') }});">
							</div>
						</div>
					</div>
				@endisset
			</div>
		</div>
	</div>
	
	<div class="card-footer">
		@isset($action)
			@isset($customer)
				<button type="submit" class="btn btn-primary mr-2">
				<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24"></rect>
						<circle fill="#000000" cx="9" cy="15" r="6"></circle>
						<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
					</g>
				</svg>
				</span>Apply Changes</button>
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
			<a href="{{ route('customers.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Cancel</a>
		@else
			<a href="{{ route('customers.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Back</a>
		@endisset
	</div>
</form>

