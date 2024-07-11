@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('admin-dashboard') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Welcome, {{ auth()->user()->name }} </h1>                
    </div>
    <hr>
    <div class="">
        <p>Yaa, halaman ini mah formalitas doang sih gaada apa apanya banget juga. </p>
        <h1 class="fs-1">:D</h1>
    </div>
@endsection