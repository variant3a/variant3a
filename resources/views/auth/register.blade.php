@extends('layouts.app')

@php($title = 'Register')

@section('header_target', 'target')

@section('content')
    <div class="flex flex-col p-2 bg-white rounded shadow sm:mx-auto sm:p-3 h-fit sm:w-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-2 sm:mb-3">
                <input type="text" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('user_id') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" name="user_id" value="{{ old('user_id') }}" placeholder="ID" autocomplete="id" required>
                @error('user_id')
                    <div class="text-sm text-red-600 dark:text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-2 sm:mb-3">
                <input type="text" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('name') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="name">
                @error('name')
                    <div class="text-sm text-red-600 dark:text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-2 sm:mb-3">
                <input type="email" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('email') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" autocomplete="email" required>
                @error('email')
                    <div class="text-sm text-red-600 dark:text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-2 sm:mb-3">
                <input type="password" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('password') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" name="password" placeholder="Password" autocomplete="new-password" required>
                @error('password')
                    <div class="text-sm text-red-600 dark:text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-2 sm:mb-3">
                <input type="password" class="w-full p-2 bg-white rounded dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password" required>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('oauth.redirect') }}" class="inline-block px-4 py-2 mr-3 font-bold text-center text-white bg-red-500 rounded shadow w-fit h-fit hover:shadow-lg hover:bg-red-400/90 ring-1 ring-black/5">
                    <i class="bi bi-google"></i>
                    Sign in as Google
                </a>
                <button type="submit" class="inline-block px-4 py-2 font-bold text-center text-white bg-teal-500 rounded shadow w-fit h-fit hover:shadow-lg hover:bg-teal-400/90 ring-1 ring-black/5" data-turbo="false">
                    Register
                </button>
            </div>
        </form>
    </div>
@endsection
