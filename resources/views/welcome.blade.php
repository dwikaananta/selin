@extends('layouts.main')

@section('content')
    <div class="row">
        @foreach ($upacara as $u)
            <div class="col-5 border rounded mb-3">
                <div class="row bg-light rounded">
                    <div class="col-4">Nama</div>
                    <div class="col-8">: {{ $u->nama }}</div>
                    <div class="col-4">Tanggal Mulai</div>
                    <div class="col-8">: {{ $u->tanggal_mulai }}</div>
                    <div class="col-4">Tanggal Selesai</div>
                    <div class="col-8">: {{ $u->tanggal_selesai }}</div>
                </div>
            </div>
            @if ($loop->odd)
                <div class="col-1"></div>
            @endif
        @endforeach
    </div>
@endsection
