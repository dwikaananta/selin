@extends('layouts.print')

@section('content')
    <h3 class="text-center" style="text-transform: uppercase">LAPORAN KAS KELUAR UPACARA {{ $upacara->nama }}</h3>
    <hr>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <body>
            @foreach ($upacara->kas_keluar as $key => $kas_keluar)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $kas_keluar->nama }}</td>
                    <td>{{ $kas_keluar->nominal }}</td>
                    <td>{{ join("-", array_reverse(explode("-", $kas_keluar->tanggal))) }}</td>
                    <td>{{ $kas_keluar->keterangan }}</td>
                </tr>
            @endforeach
        </body>
    </table>
@endsection
