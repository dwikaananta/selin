@extends('layouts.main')

@section('content')
    <form action="/urunan-user/{{ $urunan_user->id }}" method="post">
        @csrf
        @method('PATCH')
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
                <x-form-select name="user_id" :dataArr="$dataArr" :defaultValue="$urunan_user->user_id"></x-form-select>
            </div>
            <div class="col-4">
                <x-form-input name="nominal" :defaultValue="$urunan_user->nominal"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input type="date" name="tanggal" :defaultValue="$urunan_user->tanggal"></x-form-input>
            </div>
        </div>
        <x-form-save-button></x-form-save-button>
    </form>
@endsection
