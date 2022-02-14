@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body d-flex justify-content-center">
                            <div class="donut-container">
                                <div class="donut-inner d-flex justify-content-center align-items-center">
                                    <div class="donut-label">
                                        <p>{{ __('Saved') }}!</p>
                                        <a href="{{ route('home') }}">{{ __('Click here to "Home"') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
