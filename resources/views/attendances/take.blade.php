@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="card card-custom">
			<div id="customAlert">
			    <span id="alertMessage"></span>
			</div>
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title">
					<h3 class="card-label">Take Attendance</h3>
				</div>
			</div>
			<div class="flex-wrap ml-8">
				<a class="btn btn-info blind-link"><strong>Today: {{ \Carbon\Carbon::now()->format('D') }} {{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong></a>
			</div>
			<div class="card-body">
				<!--datatable-->
				<div class="datatable-attendances datatable-bordered datatable-head-custom" id="tableAttendances"></div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
    <script src="{{ asset('js/pages/attendances/take.js') }}"></script>
@stop
