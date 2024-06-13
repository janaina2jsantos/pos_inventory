@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-custom gutter-b example example-compact">
					<div class="card-header">
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
					@include('employees._form', ["employee" => $employee])
				</div>
			</div>
		</div>
	</div>
@stop

