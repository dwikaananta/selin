@extends('layouts.main')

@section('content')
    <form action="/urunan-user" method="post">
        @csrf
        <div class="row mb-2">
            <input type="hidden" name="urunan_id" value="{{ $urunan_id }}">
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
        <x-form-save-button></x-form-save-button>
    </form>
@endsection
