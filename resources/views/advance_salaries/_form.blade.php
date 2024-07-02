<form action="{{ isset($action) ? $action : '' }}" method="{{ isset($method) ? $method : '' }}">
	@csrf
	@isset($advSalary)
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
				<label>Employee&nbsp;<span class="text-danger">*</span></label>
				<select class="form-control" name="employee_id" {{ (isset($isPaid) && date('Y-m', strtotime($isPaid->month)) == $advSalary->month->format('Y-m')) ? 'disabled' : '' }}>
					<option selected disabled>Choose an option</option>
					@foreach($employees as $employee)
						<option value="{{ $employee->id }}" {{ (isset($advSalary) && $advSalary->employee_id == $employee->id) ? 'selected' : '' }}>{{ $employee->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-6 form-group">
				<label>Advance Salary&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="advance_salary" id="advanceSalary" value="{{ isset($advSalary) ? $advSalary->advance_salary : old('advance_salary') }}" placeholder="Advance Salary" {{ (isset($isPaid) && date('Y-m', strtotime($isPaid->month)) == $advSalary->month->format('Y-m')) ? 'disabled' : '' }} />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Month&nbsp;<span class="text-danger">*</span></label>
				<input type="month" class="form-control" name="month" value="{{ isset($advSalary) ? $advSalary->month->format('Y-m') : old('month') }}" {{ (isset($isPaid) && date('Y-m', strtotime($isPaid->month)) == $advSalary->month->format('Y-m')) ? 'disabled' : '' }} />
			</div>
		</div>
	</div>

	<div class="card-footer">
		@isset($advSalary)
			@if(($isPaid) && (date('Y-m', strtotime($isPaid->month)) == $advSalary->month->format('Y-m')))
				<p><span class="label label-lg label-light-danger label-inline font-weight-bold">You are not able to edit anymore. This advance has already been paid to the employee.</span></p>
				<a href="#" class="btn btn-primary mr-2" onclick="teste('{{$advSalary->id}}');">
				<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24"></rect>
						<circle fill="#000000" cx="9" cy="15" r="6"></circle>
						<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
					</g>
				</svg>
				</span>Apply this advance again this month</a>
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
				</span>Apply Changes</button>
			@endif
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
		<a href="{{ route('advance-salaries.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Cancel</a>
	</div>
</form>

