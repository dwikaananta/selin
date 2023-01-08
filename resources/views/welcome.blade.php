@extends('layouts.main')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide mb-3" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/img-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/img-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/img-3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="row justify-content-around">
        @foreach ($upacara as $u)
            <div class="col-5 border rounded mb-3">
                <div class="row bg-light rounded">
                    <div class="col-4">Nama</div>
                    <div class="col-8">: {{ $u->nama }}</div>
                    <div class="col-4">Tanggal Mulai</div>
                    <div class="col-8">: {{ $u->tanggal_mulai }}</div>
                    <div class="col-4">Tanggal Selesai</div>
                    <div class="col-8">: {{ $u->tanggal_selesai }}</div>
                    <div class="col-12">
                        <a href="/upacara/{{ $u->id }}" class="btn btn-sm btn-primary mb-1">Lihat detail . . .</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
