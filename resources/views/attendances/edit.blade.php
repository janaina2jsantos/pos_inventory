@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="card card-custom">
			<div id="customAlert">
			    <span id="alertMessage"></span>
			</div>
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				@isset($breadItems)
					@foreach($breadItems as $item)
					    @if($item['name'] !== 'Data')
					        <h3 class="card-title">{{ $item['name'] }}</h3>
					    @endif
					@endforeach
				@else
					<h3 class="card-title">{{ $breadTitle }}</h3>
				@endisset
			</div>
			<div class="flex-wrap ml-8">
				<a class="btn btn-info blind-link"><strong>Date: {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</strong></a>
			</div>
			<div class="card-body">
				<!--datatable-->
				<div class="datatable-attendances datatable-bordered datatable-head-custom"></div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
    <script src="{{ asset('js/pages/attendances/edit.js') }}"></script>
@stop
