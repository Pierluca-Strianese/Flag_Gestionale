@extends('admin.layouts.base')

@section('contents')
    <h1 class="text-center">Benvenuto <span class="fw-lighter">{{ Auth::user()->name }}</span></h1>
@endsection
