<form action="{{ isset($action) ? $action : '' }}" method="{{ isset($method) ? $method : '' }}" enctype="multipart/form-data">
	@csrf
	@isset($product)
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
					<input type="text" class="form-control" name="name" value="{{ isset($product) ? $product->name : old('name') }}" placeholder="Full Name" />
				@else
					<h4>{{ $product->name }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Code&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="code" class="form-control" name="code" value="{{ isset($product) ? $product->code : old('code') }}" placeholder="Code" />
				@else
					<h4>{{ $product->code }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Godown&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="garage" value="{{ isset($product) ? $product->garage : old('garage') }}" placeholder="Godown" />
				@else
					<h4>{{ $product->garage }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Route&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="route" value="{{ isset($product) ? $product->route : old('route') }}" placeholder="Route" />
				@else
					<h4>{{ $product->route }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Buying Price&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control money" name="buying_price" value="{{ isset($product) ? $product->buying_price : old('buying_price') }}" placeholder="Buying Price" />
				@else
					<h4>${{ $product->buying_price }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Selling Price&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control money" name="selling_price" value="{{ isset($product) ? $product->selling_price : old('selling_price') }}" placeholder="Selling Price" />
				@else
					<h4>${{ $product->selling_price }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 form-group mt-2">
				<label>Category&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<select class="form-control" name="category_id">
						<option selected disabled>Choose an option</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" {{ (isset($product) && $product->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
						@endforeach
					</select>
				@else
					<h4>{{ $product->category->name }}</h4>
				@endisset
			</div>

			<div class="col-md-6 form-group mt-2">
				<label>Supplier&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<select class="form-control" name="supplier_id">
						<option selected disabled>Choose an option</option>
						@foreach($suppliers as $supplier)
							<option value="{{ $supplier->id }}" {{ (isset($product) && $product->supplier_id == $supplier->id) ? 'selected' : '' }}>{{ $supplier->shop_name }}</option>
						@endforeach
					</select>
				@else
					<h4>{{ $product->supplier->shop_name }}</h4>
				@endisset
			</div>
		</div>	

		<div class="row">					
			<div class="col-md-6 form-group mt-2">
				<label>Buying Date&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="date" class="form-control" name="buying_date" value="{{ isset($product) ? $product->buying_date->format('Y-m-d') : old('buying_date') }}" />
				@else
					<h4>{{ $product->buying_date->format('d/m/Y') }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group mt-2">
				<label>Expire Date&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="date" class="form-control" name="expire_date" value="{{ isset($product) ? $product->expire_date->format('Y-m-d') : old('expire_date') }}" />
				@else
					<h4>{{ $product->expire_date->format('d/m/Y') }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 form-group">					
				<label>Status</label>
				@isset($action)
					<select class="form-control" name="status">
						<option value="1" {{ (!isset($product) || isset($product) && $product->status == '1') ? 'selected' : '' }}>Active</option>
						<option value="0" {{ (isset($product) && $product->status == '0') ? 'selected' : '' }}>Inactive</option>
					</select>
				@else
					<h4>{{ $product->status == 1 ? 'Active' : 'Inactive' }}</h4>
				@endisset
			</div>
		</div>

		<div class="row">
			<div class="col-lg-9 col-xl-6">
				<label>Image</label>
				@isset($action)
					<div class="col-lg-9 col-xl-6">
						<div class="image-input image-input-outline" id="kt_image_1">
							@isset($product)
								<div class="image-input-wrapper" style="background-image: url({{ isset($product->image) ? asset($product->image) : asset('dist/assets/img/products/default_image.png') }});">
								</div>
							@else
								<div class="image-input-wrapper" style="background-image: url({{ asset('dist/assets/img/products/default_image.png') }})">
								</div>
					        @endisset
							<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
								<i class="fa-solid fa-pencil text-muted"></i>
								<input type="file" name="image" accept=".png, .jpg, .jpeg" />
								<input type="hidden" name="image_remove" />
							</label>
							<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
								<i class="fa-solid fa-xmark text-muted"></i>
							</span>
						</div>
						<span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
					</div>
				@else
					<div class="col-lg-9 col-xl-6">
						<div class="image-input image-input-outline" id="productShowImage">
							@isset($product->image)
								<div class="image-input-wrapper" style="background-image: url({{ asset($product->image) }});">
								</div>
							@else
								<h4><small>Not provided</small></h4>
							@endisset
						</div>
					</div>
				@endisset
			</div>
		</div>
	</div>
	
	<div class="card-footer">
		@isset($action)
			@isset($product)
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
			<a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Cancel</a>
		@else
			<a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Back</a>
		@endisset
	</div>
</form>

