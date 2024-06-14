@extends('layouts.main')

@section('container')
<div class="container-fluid px-5 py-3 bg-tertiary vh-100">
    <div class="card m-0 p-3">
            
            @yield('content')
        </div>
    </div>
@endsection