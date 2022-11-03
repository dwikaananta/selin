@extends('layouts.main')

@section('content')
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">nama</div>
        <div class="col-md-8">: {{ $user->nama }}</div>
    </div>
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
        <div class="col-md-8">: {{ $user->jenis_kelamin }}</div>
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
        <div class="col-md-8">: {{ $user->status_kk }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">alamat</div>
        <div class="col-md-8">: {{ $user->alamat }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">status</div>
        <div class="col-md-8">: {{ $user->status }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">password</div>
        <div class="col-md-8">: {{ $user->password }}</div>
    </div>
    <x-form-save-button :submit="false"></x-form-save-button>
@endsection
