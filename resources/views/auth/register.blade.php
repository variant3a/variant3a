@extends('layouts.app')

@section('title', 'Register')

@section('header_target', 'target')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title fs-3 text-center">
                        Register
                    </div>
                    <div class="card-text text-center">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" placeholder="john" autocomplete="id" required>
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="John Doe" autocomplete="name">
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
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="email" required>
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
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="new-password" required>
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
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Password" autocomplete="new-password" required>
                                <label for="floatingPassword">
                                    Confirm Password
                                </label>
                            </div>
                            <button type="submit" class="btn btn-block btn-main-500">
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
