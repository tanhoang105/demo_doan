@extends('Client.templates.layout')
@section('title')
    - Chinhs sách
@endsection
@section('content')
    
    
    <main id="main">
        <section id="about" class="about">
            <div class="container">
                <div class="pt-3">
                    <h2 style="text-align: center;">Chính sách trung tâm</h2>
                </div>

                @foreach ($chinhsach as $value)
                    @if (($value->doi_tuong_ap_dung) == "học viên")
                <div class="pt-3">
                    <span>{!! $value->noi_dung !!}</span>
                </div>
                @endif
                @endforeach
            </div>
            

        </section>
    </main>
@endsection
