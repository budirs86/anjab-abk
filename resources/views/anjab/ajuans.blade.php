@extends('anjab.layouts.main')

@section('content')
<div class="">
    {{ Breadcrumbs::render('ajuan-analisis-jabatan') }}
</div>
        <div class="card-head mb-3">
                <h1 class="fw-light fs-4 d-inline nav-item">Daftar Ajuan Analisis Jabatan</h1>                
        </div>
        <div class="card dropdown-divider mb-3"></div>
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Status</th>
                <th></th>
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
                        <td><h5><span class="badge rounded-pill text-bg-success">Disetujui</span></h5></td=>
                    @else
                        <td><h5><span class="badge rounded-pill text-bg-danger">Revisi</span></h5></td>
                        
                    @endif
                    {{-- <td>{{  ? <p class="bad"></p> : "Revisi" }}</td> --}}
                    <td>
                        <a href="/anjab/ajuan/{{ $i }}?periode={{ $i+2020 }}" class="btn btn-primary m-0 pt-1" ><i data-feather="eye" class="m-0 p-0"></i></a>
                        @if ($i % 2 != 0)
                            <a href="/anjab/ajuan/1/edit" class="btn btn-warning"><i data-feather="edit"></i></a>
                        @else
                            <a href="/abk/ajuan" class="btn btn-success" aria-disabled="true">Buat Ajuan ABK</a>
                        @endif
                    </td>

                </tr>
            @endfor
            {{-- please  --}}
        </tbody>
        </table>
@endsection 