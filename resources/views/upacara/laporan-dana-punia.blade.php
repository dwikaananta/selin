@extends('layouts.print')

@section('content')
    <h3 class="text-center" style="text-transform: uppercase">LAPORAN DANA PUNIA UPACARA @if ($dana_punia && $dana_punia[0]) {{ $dana_punia[0]->upacara->nama }} @endif</h3>
    <hr>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Nama</th>
                <th class="text-nowrap">No HP</th>
                <th>Nominal</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <body>
            @foreach ($dana_punia as $key => $dp)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td class="text-nowrap">
                        @if ($dp->user_id)
                            <span class="text-success">User Terdaftar</span>
                        @else
                            <span class="text-info">User Tidak Terdaftar</span>
                        @endif
                    </td>
                    <td class="text-nowrap">{{ $dp->user ? $dp->user->nama : '' }}</td>
                    <td class="text-nowrap">{{ $dp->user ? $dp->user->no_hp : '' }}</td>
                    <td class="text-nowrap">{{ $dp->nominal }}</td>
                    <td class="text-nowrap">{{ join("-", array_reverse(explode("-", $dp->tanggal))) }}</td>
                </tr>
            @endforeach
        </body>
    </table>
@endsection
