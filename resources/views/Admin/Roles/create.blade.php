@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Roles') }}</div>

                <div class="card-body">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary mb-2">back</a>
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="mt-2">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <h3>Permissions:</h3>
                            @foreach ($permissions as $permission)
                                <label>
                                    <input type="checkbox" name="permissions[{{ $permission->name }}]" id="permissions" value="{{ $permission->name }}">
                                    {{ $permission->name }}
                                </label> </br>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
