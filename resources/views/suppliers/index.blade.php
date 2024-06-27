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
					<h3 class="card-label">Suppliers</h3>
				</div>
				<div class="card-toolbar">
					<div class="dropdown dropdown-inline mr-2">
						<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="svg-icon svg-icon-md">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
									<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
								</g>
							</svg>
						</span>Export</button>
						<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
							<ul class="navi flex-column navi-hover py-2">
								<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
								<li class="navi-item">
									<a href="#" class="navi-link">
										<span class="navi-icon exp-icon">
											<i class="fa-regular fa-print"></i>
										</span>
										<span class="navi-text">Print</span>
									</a>
								</li>
								<li class="navi-item">
									<a href="#" class="navi-link">
										<span class="navi-icon exp-icon">
											<i class="fa-regular fa-file-excel"></i>
										</span>
										<span class="navi-text">Excel</span>
									</a>
								</li>
								<li class="navi-item">
									<a href="#" class="navi-link">
										<span class="navi-icon exp-icon">
											<i class="fa-regular fa-file-pdf"></i>
										</span>
										<span class="navi-text">PDF</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
		
					<a href="{{ route('suppliers.create') }}" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<circle fill="#000000" cx="9" cy="15" r="6" />
								<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
							</g>
						</svg>
					</span>New Supplier</a>
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
										<label class="mr-3 mb-0 d-none d-md-block">Status:</label>
										<select class="form-control" id="kt_datatable_search_status">
											<option value="">All</option>
											<option value="0">Inactive</option>
											<option value="1">Active</option>
										</select>
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
				<div class="datatable-suppliers datatable-bordered datatable-head-custom" id="tableSuppliers"></div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
    <script src="{{ asset('js/pages/suppliers/index.js') }}"></script>
@stop
