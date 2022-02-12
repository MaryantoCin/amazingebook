@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $account->first_name }} {{ $account->middle_name }}
                        {{ $account->last_name }}</div>

                    <div class="card-body">
                        <form action="{{ route('update_role', $account) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <label for="role_id">{{ __('Role') }}: </label>
                            <select name="role_id" id="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $account->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->desc }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-warning">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
