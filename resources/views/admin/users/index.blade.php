@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('user-dashboard') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Daftar User </h1>                
    </div>
    <hr>
    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3"><i data-feather="plus"></i> Tambah</a>
        <table class="table table-striped table-bordered">
            <thead>
                <th>No</th>
                <th>Nama User</th>
                <th>Role</th>
                <th>User</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if ($user->id == auth()->user()->id)
                        @continue
                    @endif
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            {{ $user->getRoleNames()->first() }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning"><i data-feather="edit"></i></button>
                            <button type="button" class="btn btn-danger"><i data-feather="trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection