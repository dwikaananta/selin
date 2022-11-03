@extends('layouts.main')

@section('content')
    <form action="/users" method="post">
        @csrf
        <div class="row mb-2">
            <div class="col-4">
                <x-form-input name="nama"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="email"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="no_hp"></x-form-input>
            </div>
            <div class="col-4">
                @php
                    $dataArr = array_map(
                        function ($val, $key) {
                            return [
                                'key' => $key,
                                'val' => $val,
                            ];
                        },
                        $jenis_kelamin,
                        array_keys($jenis_kelamin),
                    );
                @endphp
                <x-form-radio name="jenis_kelamin" :dataArr="$dataArr" :inline="true"></x-form-radio>
            </div>
            <div class="col-4">
                <x-form-input name="tempat_lahir"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="tanggal_lahir" type="date"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="kk" label="no_kk"></x-form-input>
            </div>
            <div class="col-4">
                @php
                    $dataArr = array_map(
                        function ($val, $key) {
                            return [
                                'key' => $key,
                                'val' => $val,
                            ];
                        },
                        $status_kk,
                        array_keys($status_kk),
                    );
                @endphp
                <x-form-radio name="status_kk" :dataArr="$dataArr" :inline="true"></x-form-radio>
            </div>
            <div class="col-4">
                <x-form-textarea name="alamat"></x-form-textarea>
            </div>
            <div class="col-4">
                @php
                    $dataArr = array_map(
                        function ($val, $key) {
                            return [
                                'key' => $key,
                                'val' => $val,
                            ];
                        },
                        $status_user,
                        array_keys($status_user),
                    );
                @endphp
                <x-form-select name="status" :dataArr="$dataArr"></x-form-select>
            </div>
            <div class="col-4">
                <x-form-input name="password" type="password"></x-form-input>
            </div>
        </div>
        <x-form-save-button></x-form-save-button>
    </form>
@endsection
