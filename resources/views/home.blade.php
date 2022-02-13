@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Author') }}</th>
                                    <th scope="col">{{ __('Title') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ebooks as $ebook)
                                    <tr>
                                        <td>{{ $ebook->author }}</td>
                                        <th scope="row">
                                            <a href="{{ route('show_ebook', $ebook) }}">{{ $ebook->title }}</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
