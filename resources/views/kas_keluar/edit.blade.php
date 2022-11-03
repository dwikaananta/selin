@extends('layouts.main')

@section('content')
    <form action="/kas-keluar/{{ $kas_keluar->id }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row mb-2">
            <input type="hidden" name="upacara_id" value="{{ $upacara_id }}">
            <div class="col-4">
                <x-form-input name="nama" :defaultValue="$kas_keluar->nama"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="nominal" :defaultValue="$kas_keluar->nominal"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal" :defaultValue="$kas_keluar->tanggal"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-textarea name="keterangan" :defaultValue="$kas_keluar->keterangan"></x-form-textarea>
            </div>
        </div>
        <x-form-save-button linkBack="/upacara/{{ $upacara_id }}"></x-form-save-button>
    </form>
@endsection
