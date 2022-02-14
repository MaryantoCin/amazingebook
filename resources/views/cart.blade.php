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
                                    <th scope="col">{{ __('Title') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->ebook->title }}</td>
                                        <th>
                                            <form action="{{ route('delete_cart', $item) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">{{ __('Delete') }}</button>
                                            </form>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            <form action="{{ route('checkout_cart') }}" method="post">
                                @csrf
                                <button class="btn btn-warning" @if ($items->isEmpty())
                                    disabled
                                    @endif
                                    >{{ __('Submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
