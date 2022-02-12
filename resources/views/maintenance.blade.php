@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Account') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->first_name }} {{ $account->middle_name }}
                                            {{ $account->last_name }} - {{ $account->role->desc }}</td>
                                        <th scope="row">
                                            <a
                                                href="{{ route('show_update_role', $account) }}">{{ __('Update Role') }}</a>
                                            <form action="{{ route('delete_account', $account) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">{{ __('Delete') }}</button>
                                            </form>
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
