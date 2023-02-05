@extends('layouts.main')

@section('content')
    <div class="btn-group w-100">
        <a href="/users/{{ auth()->user()->id }}" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat Profil</a>
        <a href="/users/{{ auth()->user()->id }}/edit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah Profil</a>
    </div>

    <div class="row mb-2 border-bottom">
        <div class="col-4 title">nama</div>
        <div class="col-md-8">: {{ $user->nama }}</div>
    </div>
    @if ($user->status == 9)
        <p>You're logged in by super admin.</p>
    @else
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">email</div>
            <div class="col-md-8">: {{ $user->email }}</div>
        </div>
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">no_hp</div>
            <div class="col-md-8">: {{ $user->no_hp }}</div>
        </div>
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">jenis_kelamin</div>
            <div class="col-md-8">: {{ $jenis_kelamin[$user->jenis_kelamin] }}</div>
        </div>
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">tempat_lahir</div>
            <div class="col-md-8">: {{ $user->tempat_lahir }}</div>
        </div>
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">tanggal_lahir</div>
            <div class="col-md-8">: {{ $user->tanggal_lahir }}</div>
        </div>
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">kk</div>
            <div class="col-md-8">: {{ $user->kk }}</div>
        </div>
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">status_kk</div>
            <div class="col-md-8">: {{ $status_kk[$user->status_kk] }}</div>
        </div>
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">alamat</div>
            <div class="col-md-8">: {{ $user->alamat }}</div>
        </div>
        <div class="row mb-2 border-bottom">
            <div class="col-4 title">status</div>
            <div class="col-md-8">
                : {{ $status_user[$user->status] }}
            </div>
        </div>
    @endif
    @if (auth()->user()->status != 3)
        <x-form-save-button :submit="false"></x-form-save-button>
    @endif
@endsection
