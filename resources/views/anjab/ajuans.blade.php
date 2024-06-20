@extends('anjab.layouts.main')

@section('content')
<div class="">
    {{ Breadcrumbs::render('ajuan-analisis-jabatan') }}
</div>
        <div class="card-head mb-3">
                <h1 class="fw-light fs-4 d-inline nav-item">Daftar Ajuan Analisis Jabatan</h1>                
        </div>
        <div class="alert alert-dismissible alert-success fade show">
            <p class="m-0">Ajuan berhasil disimpan!</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="card dropdown-divider mb-3"></div>
        <table class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            {{-- Loop through the ajuan data and display each row --}}
            
            {{-- @foreach ($ajuanData as $ajuan)
            @endforeach --}}
            
            @for($i = 1; $i <= 5; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $i + 2020}}</td>
                    @if ($i % 2 == 0)
                        <td><h5><span class="badge rounded-pill text-bg-success">Disetujui</span></h5></td>
                        <td></td>
                        @else
                        <td><h5><span class="badge rounded-pill text-bg-danger">Revisi</span></h5></td>
                        <td>Mohon diperbaiki di sini dan di sana</td>
                        
                    @endif
                    {{-- <td>{{  ? <p class="bad"></p> : "Revisi" }}</td> --}}
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="/anjab/ajuan/{{ $i }}?periode={{ $i+2020 }}" class="btn btn-outline-primary">Lihat</a>
                            @if ($i % 2 != 0)
                                <a href="/anjab/ajuan/{{ $i }}/edit?periode={{ $i+2020 }}" type="button" class="btn btn-outline-secondary">Edit</a>
                                
                            @else
                                <a href="/abk/ajuan/create" class="btn btn-outline-success" aria-disabled="true">Buat Ajuan ABK</a>
                                
                            @endif
                        </div>
                        {{-- <a href="/anjab/ajuan/{{ $i }}?periode={{ $i+2020 }}" class="btn btn-sm btn-primary m-0 pt-1" ><i data-feather="eye" class="m-0 p-0"></i></a>
                        @if ($i % 2 != 0)
                            <a href="/anjab/ajuan/1/edit?periode={{ $i+2020 }}" class="btn btn-sm btn-warning"><i data-feather="edit"></i></a>
                        @else
                            <a href="/abk/ajuan/create" class="btn btn-sm btn-success" aria-disabled="true">Buat Ajuan ABK</a>
                        @endif --}}
                    </td>

                </tr>
            @endfor
            {{-- please  --}}
            </tbody>
        </table>            
@endsection 