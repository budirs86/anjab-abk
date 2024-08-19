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
    
    <div class="">
        <form action="{{ route('anjab.ajuan.store') }}" method="POST">
            @csrf
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
