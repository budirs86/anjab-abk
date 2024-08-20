@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('buat-ajuan') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Buat Ajuan Baru</h1>                
    </div>
    <div class="card dropdown-divider mb-3"></div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
        </div>        
    @endif
    <div class="">
        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" class="form-control" id="periode" name="periode" value="{{ now()->year }}" readonly>
        </div>        
        
        <livewire:jabatan-table/>
        {{-- <livewire:lihat-jabatan-table/> --}}
    </div>
    @include('anjab.partials.modaljabatan')
    @if ($errors->any())
        {{-- BANG ERROR --}}
        <script>
            const myModal = document.getElementById('modalJabatan');
            const bootstrapModal = new bootstrap.Modal(myModal);
            bootstrapModal.show();
        </script>
    @endif

    
    <div class="">
        <form action="{{ route('anjab.ajuan.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan Informasi Jabatan</button>
        </form>
    </div>

    {{-- non ajax --}}
    
    
    <script>
        const modal = document.getElementById('modalJabatan');

        modal.addEventListener('show.bs.modal', event => {
            console.log('NJIR DIPENCET');
            const btn = event.relatedTarget
            console.log(btn)

            const atasan = btn.getAttribute('data-bs-atasan')
            console.log(atasan)

            const inputAtasan = document.getElementById('parent_id');

            inputAtasan.value = atasan;
        })

        var unitKerja = document.getElementById('unit_kerja');

        select(unitKerja, {
            search: true
        });
    </script>

@endsection
