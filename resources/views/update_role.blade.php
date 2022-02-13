@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $account->first_name }} {{ $account->middle_name }}
                        {{ $account->last_name }}</div>

                    <div class="card-body">
                        <p>Last modified by {{ $account->modified_by }} at {{ $account->modified_at }}</p>
                        <form action="{{ route('update_role', $account) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <label class="pr-3" for="role_id">{{ __('Role') }}: </label>
                            <select name="role_id" id="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $account->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->desc }}</option>
                                @endforeach
                            </select>
                            <br>
                            <button class="btn btn-warning mt-3">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
