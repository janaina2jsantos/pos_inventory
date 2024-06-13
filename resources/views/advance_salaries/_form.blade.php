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
				<select class="form-control" name="employee_id">
					<option selected disabled>Choose an option</option>
					@foreach($employees as $employee)
						<option value="{{ $employee->id }}" {{ (isset($advSalary) && $advSalary->employee_id == $employee->id) ? 'selected' : '' }}>{{ $employee->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-6 form-group">
				<label>Advance Salary&nbsp;<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="advance_salary" id="advanceSalary" value="{{ isset($advSalary) ? $advSalary->advance_salary : old('advance_salary') }}" placeholder="Advance Salary" />
			</div>
		</div>

		<div class="row">					
			<div class="col-md-6 form-group">
				<label>Month&nbsp;<span class="text-danger">*</span></label>
				<input type="month" class="form-control" name="month" value="{{ isset($advSalary) ? $advSalary->month->format('Y-m') : old('month') }}" />
			</div>
		</div>
	</div>
	
	<div class="card-footer">
		@isset($advSalary)
			<button type="submit" class="btn btn-primary mr-2">Apply Changes</button>
		@else
			<button type="submit" class="btn btn-primary mr-2">Save</button>
		@endisset
		<a href="{{ route('advance-salaries.index') }}" class="btn btn-secondary">Cancel</a>
	</div>
</form>

