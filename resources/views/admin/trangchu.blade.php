@extends('Admin.templates.layout')
@section('content')
    <div class="d-flex justify-content-center p-5">
          <h2 style="font-weight: 600"> XIN CHÀO {{ mb_strtoupper(Auth::user()->name ) }}</h2>
    </div>
    
@endsection
