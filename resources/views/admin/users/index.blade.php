@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('user-dashboard') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Daftar User </h1>                
    </div>
    <hr>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                    @if ($user->id == auth()->user()->id or $user->hasRole('superadmin'))
                        @continue
                    @endif
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            {{ $user->getRoleNames()->first() }}
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit',['user' => $user->id]) }}" type="button" class="btn btn-warning"><i data-feather="edit"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusUser{{ $user->email }}"><i data-feather="trash"></i></button>
                            <div class="modal fade" tabindex="-1" id="modalHapusUser{{ $user->email }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus User?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>User yang sudah dihapus tidak akan bisa dikembalikan lagi.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.users.destroy',['user' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" value="{{ $user->id }}">
                                                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Ya</button>

                                            </form>
                                            <button type="button" class="btn btn-primary">Tidak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection