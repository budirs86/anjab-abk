@extends('layouts.main')

@section('container')
<div class="container-fluid rounded my-5 shadow p-3 bg-white">
    @yield('content')
</div>
    {{-- <div class="container-fluid px-5 py-3 my-5 bg-tertiary vh-100">
        <div class="card shadow-lg m-0 p-3">
            </div>
        </div> --}}
@endsection