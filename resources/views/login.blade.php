@extends('layouts.main')

@section('content')
    <div class="row justify-content-center vh-100 align-items-center bg-light">
        <div class="col-6">
            <img src="/img/login.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-6">
            <form action="" class="text-center" method="POST">
                <h3>{{ env('APP_NAME') }}</h3>
                @csrf
                <div class="mb-2">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-primary mb-3">
                    <i class="mr-2 fa fa-sign-in"></i>
                    Login</button>
                <a href="/">Back to home !</a>
            </form>
        </div>
    </div>
@endsection
