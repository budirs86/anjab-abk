@extends('layouts.main')


@section('container')
    <div class="">
        {{ Breadcrumbs::render('lihat-ajuan-abk', $ajuan) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Analisis Beban Kerja Periode {{ $ajuan->tahun }}</h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <table class="table table-striped table-bordered">
        <thead>
            <th class="fw-semibold text-muted">No</th>
            <th class="fw-semibold text-muted">Unit Kerja/Lembaga/Sekolah</th>
            @can('make abk')
                <th class="fw-semibold text-muted">Status</th>
                <th class="fw-semibold text-muted">Catatan Perbaikan</th>
            @elsecan('verify ajuan')
                <th class="fw-semibold text-muted">Diajukan Tanggal</th>
            @endcan

        </thead>
        <tbody>
            @foreach ($unit_kerjas as $unit_kerja)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>{{ $unit_kerja->nama }}</p>
                            {{-- create edit and lihat button group --}}
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @if ($ajuan->verifikasi->count() == 0)
                                    <a href="{{ route('abk.unitkerja.show', [$ajuan, $unit_kerja]) }}"
                                        class="btn btn-outline-primary">Lihat</a>
                                    @can('make abk')
                                        <a href="{{ route('abk.unitkerja.edit', [$ajuan, $unit_kerja]) }}"
                                            class="btn btn-outline-secondary">Edit</a>
                                    @endcan
                                @else
                                    @if (!$ajuan->latest_verifikasi()->is_approved && $ajuan->next_verificator()->role->name == 'Operator Unit Kerja')
                                        <a href="{{ route('abk.unitkerja.show', [$ajuan, $unit_kerja]) }}"
                                            class="btn btn-outline-primary">Lihat</a>
                                    @endif
                                    @can('make abk')
                                        <a href="{{ route('abk.unitkerja.edit', [$ajuan, $unit_kerja]) }}"
                                            class="btn btn-outline-secondary">Edit</a>
                                    @endcan
                                @endif
                            </div>
                        </div>
                    </td>
                    @can('make abk')
                        <td class="w-25">
                            {{-- check if latest verification exists, if exists and latest verification is not approved, show alert warning --}}
                            @if (!empty($ajuan->latest_verifikasi()) && !$ajuan->latest_verifikasi()->is_approved)
                                <div class="alert alert-warning w-100">
                                    <div class="alert-heading d-flex">
                                        <img width="20px" data-feather="alert-triangle" class="m-0 p-0 me-2"></img>
                                        <p class="m-0 p-0">Perlu Perbaikan</p>
                                    </div>
                                    <hr>
                                    <p class="m-0 p-0">{{ $ajuan->latest_verificator() }}</p>
                                </div>
                            @endif

                            {{-- if someone has verified the ajuan, display alert success --}}
                            @if ($ajuan->approved_verificator()->count() && $ajuan->latest_verificator() != 'Operator Unit Kerja')
                                <div class="alert alert-success w-100">
                                    <div class="alert-heading d-flex">
                                        <img width="20px" data-feather="check-circle" class="m-0 p-0 me-2"></img>
                                        <p class="m-0 p-0">Disetujui</p>
                                    </div>
                                    <hr>
                                    <ul>
                                        @foreach ($ajuan->approved_verificator() as $verificator)
                                            <li>
                                                {{ $verificator->role->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- if there is still someone to verify, display alert info --}}
                            @if ($ajuan->next_verificator() && $ajuan->next_verificator()->role->name != 'Operator Unit Kerja')
                                <div class="alert alert-info w-100">
                                    <div class="alert-heading d-flex">
                                        <img width="20px" data-feather="clock" class="m-0 p-0 me-2"></img>
                                        <p class="m-0 p-0">Menunggu Diperiksa</p>
                                    </div>
                                    <hr>
                                    <p class="m-0 p-0">
                                        {{ $ajuan->next_verificator()->role->name }}
                                    </p>
                                </div>
                            @endif
                        </td>
                    @elsecan('verify ajuan')
                        <td>{{ now()->format('d-m-Y') }}</td>
                    @endcan
                    <td>
                        @if (!empty($ajuan->latest_verifikasi()) && !$ajuan->latest_verifikasi()->is_approved)
                            <p>{{ $ajuan->latest_verifikasi()->catatan }}</p>
                        @else
                            <p>Tidak ada catatan.</p>
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <a href="{{ route('abk.ajuans') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
@endsection
