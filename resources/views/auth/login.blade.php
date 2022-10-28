@extends('layouts.app')

@php($title = 'Login')

@section('header_target', 'target')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">
            <div class="card text-bg-800 shadow">
                <div class="card-body">
                    <div class="card-title fs-3 text-center">
                        Login
                    </div>
                    <div class="card-text text-center">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control border-700 text-bg-700 @error('email') is-invalid @enderror" name="email" placeholder="name@example.com" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            @error('email')
                                <div class="invalid-feedback text-left">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-700 text-bg-700 @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                                <label for="floatingInput">Password</label>
                                @error('password')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('oauth.redirect') }}" class="btn btn-red-500">
                                    <i class="bi bi-google"></i>
                                    Sign in as Google
                                </a>
                                <button type="submit" class="btn btn-block btn-main-500">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
