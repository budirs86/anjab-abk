@extends('layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
        </div>
        
    @endif
    <div class="">
        {{ Breadcrumbs::render('buat-ajuan') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Buat Ajuan Baru</h1>                
    </div>
    <div class="card dropdown-divider mb-3"></div>

    <div class="">
        <div class="alert alert-info alert-dismissible fade show">
                <div class="alert-heading d-flex justify-content-between">
                    <div class="d-flex">
                        <img width="20px" data-feather="info" class="m-0 p-0 me-2"></img>
                        <p class="m-0 p-0">Perhatian</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <hr>  
                <p class="m-0 p-0">Silahkan Pilih Unit Kerja, lalu isi Jabatan dan Informasi Jabatan untuk tiap Unit Kerja</p>
        </div>
        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" class="form-control" id="periode" name="periode" value="{{ now()->year }}" readonly>
        </div>        

        <table class="table table-striped table-bordered">
            <thead >
                <th class="fw-semibold text-muted">Kode</th>
                <th class="fw-semibold text-muted d-flex">Jabatan 
                    <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan=""><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
                </th>
            </thead>
            <tbody>
                @foreach ($jabatans as $jabatan)
                    <tr>
                        <td>K - 123</td>
                        <td class="d-flex justify-content-between">
                            <p class="" href="/anjab/analisis-jabatan/create" style="">{{ $jabatan->nama }}</p>
                            <div class="div">
                                <a href="{{ route('anjab.jabatan.edit.step-one', ['jabatan'=> $jabatan->id]) }}" class="btn btn-sm btn-primary ms-auto add-button"><img width="20px" data-feather="edit-3"></img> Ubah Informasi Jabatan</a>
                                {{-- <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan Bawahan</button> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                    
            </tbody>
        </table>
    </div>
    @include('anjab.partials.modaljabatan')
    
    <div class="">
        <form action="{{ route('anjab.ajuan.store') }}" method="POST">
            @csrf
            @foreach ($jabatans as $jabatan)
                <input type="text" name="jabatans[{{ $loop->index }}]" value="{{ $jabatan->id }}" hidden>
            @endforeach
            <button type="submit" class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan Informasi Jabatan</button>
        </form>
    </div>

    {{-- non ajax --}}
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#modalJabatan').modal('show')
            });
        </script>
    @endif
    
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
        {{-- ajax --}}
        {{-- <script>
            
            $(document).ready(function() {
                $('#submitJabatan').click(function(event) {
                    event.preventDefault();

                    $.ajax({
                        url : "/anjab/data-jabatan",
                        method : 'POST',
                        data : $('#jabatanForm').serialize(),
                        dataType: "json",
                        success: function(response){
                            console.log("Response:", response);
                            if(response.success) {

                                $('#modalExample').modal('hide');
                            }
                            else {
                                const errors = response.errors;

                                // Loop through errors and update form fields
                                for (const field in errors) {
                                    const errorMessage = errors[field][0];
                                    $(`#${field}`).addClass('is-invalid');
                                    $(`#${field} + .invalid-feedback`).text(errorMessage);
                                }

                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Handle any errors during the AJAX request
                            console.error("Error:", textStatus, errorThrown);
                        }
                    })
                })
            })

        </script> --}}
@endsection
