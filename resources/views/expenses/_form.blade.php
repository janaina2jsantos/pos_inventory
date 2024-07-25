<form action="{{ isset($action) ? $action : '' }}" method="{{ isset($method) ? $method : '' }}">
	@csrf
	@isset($expense)
        {{ method_field('PUT') }}
    @endisset

    @if (session()->has('success'))
        <div class="col-md-6 alert alert-custom alert-light-primary fade show mb-5 col-success" role="alert">
		    <div class="alert-text">
		    	<span class="svg-icon svg-icon-primary svg-icon-2x">
				    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					        <polygon points="0 0 24 0 24 24 0 24"/>
					        <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>
					    </g>
					</svg>
				</span>
				{{ session('success') }}
			</div>
		    <div class="alert-close">
		        <button type="button" class="close btn-close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
		        </button>
		    </div>
		</div>
    @endif

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
			<div class="col-md-12 form-group">
				<label>Details&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<textarea class="form-control" name="details" rows="4" style="resize:none;">{{ isset($expense) ? $expense->details : old('details') }}</textarea>
				@else
					<h4>{{ $expense->amount }}</h4>
				@endisset
			</div>
			<div class="col-md-6 form-group">
				<label>Amount&nbsp;<span class="text-danger">*</span></label>
				@isset($action)
					<input type="text" class="form-control" name="amount" id="amount" placeholder="Expense Amount" value="{{ isset($expense) ? $expense->amount : old('amount') }}" />
				@else
					<h4>{{ $expense->amount }}</h4>
				@endisset
			</div>
		</div>
	</div>
	
	<div class="card-footer">
		@isset($action)
			@isset($expense)
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
			<a href="{{ route('expenses.today') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Cancel</a>
		@else
			<a href="{{ route('expenses.today') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Back</a>
		@endisset
	</div>
</form>

