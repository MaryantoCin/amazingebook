@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <p>Success!</p>
                        <a href="{{ route('home') }}">Click here to "Home"</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
