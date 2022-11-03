@extends('layouts.main')

@section('content')
    <form action="/kas-keluar" method="post">
        @csrf
        <div class="row mb-2">
            <input type="hidden" name="upacara_id" value="{{ $upacara_id }}">
            <div class="col-4">
                <x-form-input name="nama"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="nominal"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-textarea name="keterangan"></x-form-textarea>
            </div>
        </div>
        <x-form-save-button linkBack="/upacara/{{ $upacara_id }}"></x-form-save-button>
    </form>
@endsection
