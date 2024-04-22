@extends('layouts.main')

@section('container')
    <div class="container mt-5">
        <div class="row">
                <div class="col">
                    <h2>Grafik Jabatan Berdasarkan Jenis</h2>
                    <img
                        src="/assets/pie-chart.svg"
                        alt="Grafik"
                        width="250"
                    />
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col py-2">
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <h3 class="fs-5">Total Jabatan Struktural</h3>
                                <p class="fs-4">27</p>
                            </div>
                            <div
                                class="bg-primary w-100 rounded-pill"
                                style="height: 5px"
                            ></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col py-2">
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <h3 class="fs-5">Total Jabatan Pelaksana</h3>
                                <p class="fs-4">27</p>
                            </div>
                            <div
                                class="bg-danger w-100 rounded-pill"
                                style="height: 5px"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col py-2">
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <h3 class="fs-5">Total Jabatan Fungsional</h3>
                                <p class="fs-4">27</p>
                            </div>
                            <div
                                class="bg-warning w-100 rounded-pill"
                                style="height: 5px"
                            ></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col py-2">
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <h3 class="fs-5">Total Pegawai</h3>
                                <p class="fs-4">27</p>
                            </div>
                            <div
                                class="bg-success w-100 rounded-pill"
                                style="height: 5px"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
@endsection