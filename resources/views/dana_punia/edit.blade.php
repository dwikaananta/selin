@extends('layouts.main')

@section('content')
    <form action="/dana-punia/{{ $dana_punia->id }}?upacara_id={{ $upacara_id }}" method="post">
        @csrf
        @method('PATCH')
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
                <x-form-select name="user_id" :dataArr="$dataArr" :defaultValue="$dana_punia->user_id"></x-form-select>
            </div>
            <div class="col-4">
                <x-form-input name="nominal" :defaultValue="$dana_punia->nominal"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal" :defaultValue="$dana_punia->tanggal"></x-form-input>
            </div>
        </div>
        <hr>
        <div class="row mb-2">
            <h4>Optional (Jika pemberi dana punia bukan berasal dari user terdaftar)</h4>
            <div class="col-4">
                <x-form-input name="nama" :defaultValue="$dana_punia->nama"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="no_hp" :defaultValue="$dana_punia->no_hp"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-textarea name="alamat" :defaultValue="$dana_punia->alamat"></x-form-textarea>
            </div>
        </div>
        <x-form-save-button linkBack="/upacara/{{ $upacara_id }}"></x-form-save-button>
    </form>
@endsection
