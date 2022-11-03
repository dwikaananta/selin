@extends('layouts.main')

@section('content')
    <form action="/upacara" method="post">
        @csrf
        <div class="row mb-2">
            <div class="col-4">
                <x-form-input name="nama"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal_mulai"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal_selesai"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="total_sesari"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-textarea name="keterangan"></x-form-textarea>
            </div>
        </div>
        <x-form-save-button></x-form-save-button>
    </form>
@endsection
