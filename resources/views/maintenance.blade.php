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
                                    <th class="text-center" scope="col">{{ __('Account') }}</th>
                                    <th class="text-center" scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td class="text-center"> {{ $account->first_name }}
                                            {{ $account->middle_name }}
                                            {{ $account->last_name }} - {{ $account->role->role_desc }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a class="btn btn-link"
                                                href="{{ route('show_update_role', $account) }}">{{ __('Update Role') }}</a>
                                            <form action="{{ route('delete_account', $account) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
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
