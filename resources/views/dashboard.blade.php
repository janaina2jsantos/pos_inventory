@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="card card-custom bgi-no-repeat card-stretch card-progress gutter-b" style=" background-image: url({{asset('dist/assets/img/svg/abstract-3.svg')}})">
                    <div class="card-body my-4">
                        <a href="#" class="card-title font-weight-bolder text-info font-size-h6 mb-4 text-hover-state-dark d-block">SAP UI Progress</a>
                        <div class="font-weight-bold text-muted font-size-sm">
                        <span class="text-dark-75 font-weight-bolder font-size-h2 mr-2">67%</span>Avarage</div>
                        <div class="progress progress-xs mt-7 bg-info-o-60">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 67%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-custom {{ $salariesToPay > 0 ? 'bg-danger' : 'bg-info payments' }} bg-info card-stretch card-salaries gutter-b" style="background-image: url({{ $salariesToPay > 0 ? asset('dist/assets/img/misc/warning.png') : '' }})">
                    <div class="card-body my-4">
                        <a href="{{ route('pay.salary') }}" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Salaries to Pay</a>
                        <div class="font-weight-bold text-white font-size-sm">
                        <span class="font-size-h2 mr-2">{{ $salariesToPay }}</span>{{ $salariesToPay > 0 ? 'Payments to be made' : 'No outstanding payments' }}</div>
                        <div class="progress progress-xs mt-7 bg-white-o-90">
                            <div class="progress-bar bg-white" role="progressbar" style="width: {{ $pctm }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-custom bg-dark card-stretch gutter-b">
                    <div class="card-body my-4">
                        <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Customer</a>
                        <div class="font-weight-bold text-white font-size-sm">
                        <span class="font-size-h2 mr-2">52,450</span>48k to goal</div>
                        <div class="progress progress-xs mt-7 bg-white-o-90">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 52%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-xxl-4 order-1 order-xxl-2">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">Authors</h3>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex align-items-center mb-2">
                            <div class="symbol symbol-40 symbol-light-success mr-5">
                                <span class="symbol-label">
                                    <img src="{{asset('dist/assets/img/svg/011-boy-5.svg')}}" class="h-75 align-self-end" alt="" />
                                </span>
                            </div>
                            <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                                <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Carles Puyol</a>
                                <span class="text-muted">PHP, SQLite, Artisan CLI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xxl-4 order-1 order-xxl-2">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">Authors</h3>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex align-items-center mb-2">
                            <div class="symbol symbol-40 symbol-light-success mr-5">
                                <span class="symbol-label">
                                    <img src="{{asset('dist/assets/img/svg/011-boy-5.svg')}}" class="h-75 align-self-end" alt="" />
                                </span>
                            </div>
                            <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                                <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Carles Puyol</a>
                                <span class="text-muted">PHP, SQLite, Artisan CLI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop