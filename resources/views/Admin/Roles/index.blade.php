@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Roles') }}</div>

                <div class="card-body">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-2">Create Role</a>
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th width="40px">ID</th>
                                <th>Roles</th>
                                <th width="200px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                @if ($role->name !== 'admin')
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>             
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
