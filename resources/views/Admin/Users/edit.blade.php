@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>

                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-2">back</a>
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mt-2">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="roles">Role:</label>
                            <select class="form-select" name="roles" id="roles">
                                <option value="" selected disabled>-- Select Role --</option>
                                @foreach ($roles as $role)
                                     @if($role->name !== 'admin')
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? "selected" : "" }} >{{ $role->name }}</option>
                                    @endif 
                                @endforeach
                            </select>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="password">Pasword:</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
