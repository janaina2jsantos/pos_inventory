@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="card card-custom">
			@if (session()->has('success'))
		        <div class="col-md-6 alert alert-custom alert-light-primary fade show mb-5 col-success" role="alert">
				    <div class="alert-text">{{ session('success') }}</div>
				    <div class="alert-close">
				        <button type="button" class="close btn-close" data-dismiss="alert" aria-label="Close">
				            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
				        </button>
				    </div>
				</div>
		    @endif
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title">
					<h3 class="card-label">Pay Salary</h3>
				</div>

				<div class="card-toolbar">
					<a class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<circle fill="#000000" cx="9" cy="15" r="6" />
								<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
							</g>
						</svg>
					</span>{{ date("F Y") }}</a>
				</div>
			</div>
			<!-- filters -->
			<div class="card-body">
				<div class="mb-7">
					<div class="row align-items-center">
						<div class="col-lg-9 col-xl-8">
							<div class="row align-items-center">
								<div class="col-md-6 my-2 my-md-0">
									<div class="input-icon">
										<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
										<span>
											<i class="fa-solid fa-magnifying-glass"></i>
										</span>
									</div>
								</div>

								<div class="col-md-6 my-2 my-md-0">
									<div class="d-flex align-items-center">
										<label class="mr-3 mb-0 d-none d-md-block">Month:</label>
										<input type="month" class="form-control" id="kt_datatable_search_month" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
							<a href="#" class="btn btn-light-primary px-6 font-weight-bold" id="kt_datatable_search_button">Search</a>
						</div>
					</div>
				</div>
				<!--datatable-->
				<div class="datatable-pay-salary datatable-bordered datatable-head-custom" id="tablePaySalary"></div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
    <script src="{{ asset('js/pages/advance_salaries/paySalary.js') }}"></script>
@stop
