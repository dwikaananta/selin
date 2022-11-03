@extends('layouts.main')

@section('content')
    <form action="/dana-punia" method="post">
        @csrf
        <div class="row mb-2">
            <input type="hidden" name="upacara_id" value="{{ $upacara_id }}">
            <div class="col-4">
                @php
                    $dataArr = [];
                    foreach ($users as $user) {
                        $dataArr[] = [
                            'key' => $user->id,
                            'val' => $user->nama,
                        ];
                    }
                @endphp
                <x-form-select name="user_id" :dataArr="$dataArr"></x-form-select>
            </div>
            <div class="col-4">
                <x-form-input name="nominal"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal"></x-form-input>
            </div>
        </div>
        <hr>
        <div class="row mb-2">
            <h4>Optional (Jika pemberi dana punia bukan berasal dari user terdaftar)</h4>
            <div class="col-4">
                <x-form-input name="nama"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="no_hp"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-textarea name="alamat"></x-form-textarea>
            </div>
        </div>
        <x-form-save-button linkBack="/upacara/{{ $upacara_id }}"></x-form-save-button>
    </form>
@endsection
