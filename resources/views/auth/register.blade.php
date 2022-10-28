@extends('layouts.app')

@php($title = 'Register')

@section('header_target', 'target')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">
            <div class="card text-bg-800 shadow">
                <div class="card-body">
                    <div class="card-title fs-3 text-center">
                        Register
                    </div>
                    <div class="card-text text-center">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-700 text-bg-700 @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" placeholder="john" autocomplete="id" required>
                                <label for="floatingInput">
                                    ID
                                </label>
                                @error('user_id')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-700 text-bg-700 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="John Doe" autocomplete="name">
                                <label for="floatingInput">
                                    Name
                                </label>
                                @error('name')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control border-700 text-bg-700 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="email" required>
                                <label for="floatingInput">
                                    Email address
                                </label>
                                @error('email')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-700 text-bg-700 @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="new-password" required>
                                <label for="floatingPassword">
                                    Password
                                </label>
                                @error('password')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-700 text-bg-700" name="password_confirmation" placeholder="Password" autocomplete="new-password" required>
                                <label for="floatingPassword">
                                    Confirm Password
                                </label>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('oauth.redirect') }}" class="btn btn-red-500">
                                    <i class="bi bi-google"></i>
                                    Sign in as Google
                                </a>
                                <button type="submit" class="btn btn-block btn-main-500">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
