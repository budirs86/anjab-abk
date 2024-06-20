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
            <div class="">
                {{ Breadcrumbs::render('data-jabatan') }}
            </div>
            <div class="card-head mb-3">
                <h1 class="fw-light fs-4 d-inline nav-item">Susunan Informasi Jabatan</h1>                
            </div>
            <div class="card dropdown-divider mb-3"></div>

            <div class="">
                <div class="mb-3">
                    <label for="unit_kerja" class="form-label">Unit Kerja</label>
                    <select class="form-select" id="unit_kerja" name="unit_kerja">
                        <option value="Bidang Kepegawaian">Bidang Kepegawaian</option>
                        <option value="Bidang Keuangan">Bidang Keuangan</option>
                        <option value="Bidang Teknologi Informasi">Bidang Teknologi Informasi</option>
                        <option value="Bidang Pengembangan Sumber Daya Manusia">Bidang Pengembangan Sumber Daya Manusia</option>
                    </select>
                </div>
                

                <table class="table table-striped table-bordered">
                    <thead >
                        {{-- <th class="fw-semibold text-muted">Action</th> --}}
                        <th class="fw-semibold text-muted">Kode</th>
                        <th class="fw-semibold text-muted">Jabatan</th>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td>
                                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target=".collapseparent0">Expand</button>
                            </td>
                            <td>// K-123 //</td>
                            <td class="d-flex justify-content-start">
                                <p>Bidang Kepegawaian</p>
                                <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#modalJabatan"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
                            </td>
                        </tr>                                 --}}
                        @foreach ($jabatans as $jabatan)
                            <x-table-row :jabatan="$jabatan" :editable="true"/>    
                        @endforeach
                            
                    </tbody>
                </table>
            </div>
                @include('anjab.partials.modaljabatan')
                
                <div class="">
                    <a href="/anjab/ajuans"  class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan Informasi Jabatan</a>
                </div>
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
    </div>
@endsection