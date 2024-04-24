@extends('layouts.main')

@section('container')
    <div class="container-fluid px-5 py-3 bg-tertiary vh-100">
        <div class="card m-0 p-3">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                </div>
                
            @endif
            <div class="card-head mb-3">
                <h1 class="fw-light fs-4 d-inline nav-item">Data Jabatan</h1>                
            </div>
            <div class="card dropdown-divider mb-5"></div>

            <div class="">
                <table class="table table-striped table-bordered">
                    <thead >
                        <th class="fw-semibold text-muted">Action</th>
                        <th class="fw-semibold text-muted">Kode</th>
                        <th class="fw-semibold text-muted">Unit Kerja</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample">Expand</button>
                            </td>
                            <td>// K-123 //</td>
                            <td class="d-flex justify-content-between">
                                <p>Bidang Kepegawaian</p>
                                <button class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#modalExample"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
                            </td>
                        </tr>
                        
                        {{-- <tr class="collapse" id="collapseExample">
                            <td><button class="btn btn-dark">Expand</button></td>
                            <td>// K-123 //</td>
                            <td class="d-flex justify-content-between">
                                <p>ABCD</p>
                                <button class="btn btn-success ms-2"> Tambah Jabatan</button>
                            </td>
                        </tr> --}}
                        
                        {{-- <tr class="collapse" id="collapseExample">
                            @foreach ($jabatans as $jabatan)
                            <tr>
                                <td><button class="btn btn-dark">Expand</button></td>
                                <td>// K-123 //</td>
                                <td class="d-flex justify-content-between">
                                    <p>{{ $jabatan->nama_jabatan }}</p>
                                    <button class="btn btn-success ms-2"> Tambah Jabatan</button>
                                </td>
                            </tr>
                            <tr>
                                <td><button class="btn btn-dark">Expand</button></td>
                                <td>// K-123 //</td>
                                <td class="d-flex justify-content-between">
                                    <p>{{ $jabatan->nama_jabatan }}</p>
                                    <button class="btn btn-success ms-2"> Tambah Jabatan</button>
                                </td>
                            </tr>
                            <tr>
                                <td><button class="btn btn-dark">Expand</button></td>
                                <td>// K-123 //</td>
                                <td class="d-flex justify-content-between">
                                    <p>{{ $jabatan->nama_jabatan }}</p>
                                    <button class="btn btn-success ms-2"> Tambah Jabatan</button>
                                </td>
                            </tr>
                            <tr>
                                <td><button class="btn btn-dark">Expand</button></td>
                                <td>// K-123 //</td>
                                <td class="d-flex justify-content-between">
                                    <p>{{ $jabatan->nama_jabatan }}</p>
                                    <button class="btn btn-success ms-2"> Tambah Jabatan</button>
                                </td>
                            </tr>
                            @endforeach
                        </tr> --}}
                    
                    </tbody>
                </table>
            </div>

        </div>
        @include('anjab.partials.modaljabatan')
    </div>
@endsection