@extends('layouts.main')

@section('content')
    <form action="/urunan" method="post">
        @csrf
        <div class="row mb-2">
            <div class="col-4">
                <x-form-input name="nama"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="nominal_dibutuhkan"></x-form-input>
            </div>
            <div class="col-4">
                <x-form-input name="nominal_per_orang"></x-form-input>
            </div>
        </div>
        <x-form-save-button></x-form-save-button>
    </form>
@endsection
