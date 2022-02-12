@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('E-Book Detail') }}</div>

                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $ebook->title }}</td>
                                </tr>
                                <tr>
                                    <th>Author:</th>
                                    <td>{{ $ebook->author }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $ebook->description }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            <form action="{{ route('rent_ebook', $ebook) }}" method="post">
                                @csrf
                                <button class="btn btn-warning">Rent</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
