@extends('layouts.main')

@section('container')
    <div class="container-fluid px-5 py-3 bg-tertiary vh-100">
        <div class="card m-0 p-3">
            <div class="card-head mb-3">
                <h1 class="fw-light fs-4 d-inline nav-item">{{ $title }}</h1>
                <div class="card dropdown-divider mb-5"></div>
                
                <form action="/anjab/analisis-jabatan" method="POST">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="ikhtisar" style="height: 100px"></textarea>
                        <label for="ikhtisar">Ikhtisar Jabatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="objek_kerja" 
                        placeholder="Masukkan Objek kerja">
                        <label for="objek_kerja">Objek Kerja</label>
                    </div>

                    <p>URAIAN TUGAS</p>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="tanggungjawab" style="height: 100px"></textarea>
                        <label for="tanggungjawab">Tanggung Jawab</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="wewenang" style="height: 100px"></textarea>
                        <label for="wewenang">Wewenang</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection