@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="card card-custom">
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
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title">
					<h3 class="card-label">Attendances</h3>
				</div>
				<div class="card-toolbar">		
					<a href="{{ route('attendances.take') }}" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<circle fill="#000000" cx="9" cy="15" r="6" />
								<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
							</g>
						</svg>
					</span>Take New Attendance</a>
				</div>
			</div>
			<div class="card-body">
				<!-- filters -->
				<div class="mb-7">
					<div class="row align-items-center">
						<div class="col-lg-9 col-xl-8">
							<div class="row align-items-center">
								<div class="col-md-6 my-2 my-md-0">
									<div class="d-flex align-items-center">
										<label class="mr-3 mb-0 d-none d-md-block">Month:</label>
										<input type="month" class="form-control" id="kt_datatable_search_month" />
									</div>
								</div>
								<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
									<a href="#" class="btn btn-light-primary px-6 font-weight-bold" id="kt_datatable_search_button">Search</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--datatable-->
				<div class="datatable-attendances datatable-bordered datatable-head-custom"></div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
    <script src="{{ asset('js/pages/attendances/index.js') }}"></script>
@stop
