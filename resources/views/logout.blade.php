@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="card-body d-flex justify-content-center">
                            <div class="donut-container">
                                <div class="donut-inner d-flex justify-content-center align-items-center">
                                    <div class="donut-label">Log Out Success!</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
