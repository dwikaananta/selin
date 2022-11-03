@extends('layouts.main')

@section('content')
    <form action="/upacara/{{ $upacara->id }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row mb-2">
            <div class="col-4">
                <x-form-input name="nama" :defaultValue="$upacara->nama"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal_mulai" :defaultValue="$upacara->tanggal_mulai"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal_selesai" :defaultValue="$upacara->tanggal_selesai"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="total_kas_keluar" :defaultValue="$upacara->total_kas_keluar"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="total_sesari" :defaultValue="$upacara->total_sesari"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-textarea name="keterangan" :defaultValue="$upacara->keterangan"></x-form-textarea>
            </div>
        </div>
        <x-form-save-button></x-form-save-button>
    </form>
@endsection
