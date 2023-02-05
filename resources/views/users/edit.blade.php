@extends('layouts.main')

@section('content')
    <div class="btn-group w-100">
        <a href="/users/{{ auth()->user()->id }}" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat Profil</a>
        <a href="/users/{{ auth()->user()->id }}/edit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah Profil</a>
    </div>

    <form action="/users/{{ $user->id }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row mb-2">
            <div class="col-4">
                <x-form-input name="nama" defaultValue="{{ $user->nama }}"></x-form-input>
            </div>
            @if ($user->status == 9)
                <p>You're logged in by super admin.</p>
            @else
                <div class="col-4">
                    <x-form-input name="email" defaultValue="{{ $user->email }}"></x-form-input>
                </div>
                <div class="col-4">
                    <x-form-input name="no_hp" defaultValue="{{ $user->no_hp }}"></x-form-input>
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
                    <x-form-radio name="jenis_kelamin" :dataArr="$dataArr" :inline="true"
                        defaultValue="{{ $user->jenis_kelamin }}"></x-form-radio>
                </div>
                <div class="col-4">
                    <x-form-input name="tempat_lahir" defaultValue="{{ $user->tempat_lahir }}"></x-form-input>
                </div>
                <div class="col-4">
                    <x-form-input name="tanggal_lahir" defaultValue="{{ $user->tanggal_lahir }}" type="date">
                    </x-form-input>
                </div>
                <div class="col-4">
                    <x-form-input name="kk" defaultValue="{{ $user->kk }}" label="no_kk"></x-form-input>
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
                    <x-form-radio name="status_kk" :dataArr="$dataArr" :inline="true"
                        defaultValue="{{ $user->status_kk }}">
                    </x-form-radio>
                </div>
                <div class="col-4">
                    <x-form-textarea name="alamat" defaultValue="{{ $user->alamat }}"></x-form-textarea>
                </div>
                @if (auth()->user()->status != 3)
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
                        <x-form-select name="status" :dataArr="$dataArr" defaultValue="{{ $user->status }}"></x-form-select>
                    </div>
                @endif
                <div class="col-4">
                    <x-form-input name="password" type="password"></x-form-input>
                </div>
            @endif
        </div>
        <x-form-save-button></x-form-save-button>
    </form>
@endsection
