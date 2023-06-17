@extends('layouts.app')

@php($title = 'Register')

@section('header_target', 'target')

@section('content')
    <div class="flex flex-col p-3 bg-neutral-800 rounded-3xl sm:mx-auto sm:p-4 h-fit sm:w-fit text-neutral-700">
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            <div>
                @csrf
                <input type="text" class="p-2 w-64 rounded ring-1 ring-neutral-600 bg-transparent ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('user_id') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" name="user_id" value="{{ old('user_id') }}" placeholder="ID" autocomplete="id" required>
                @error('user_id')
                    <div class="text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <input type="text" class="p-2 w-64 rounded ring-1 ring-neutral-600 bg-transparent ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('name') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="name">
                @error('name')
                    <div class="text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <input type="email" class="p-2 w-64 rounded ring-1 ring-neutral-600 bg-transparent ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('email') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" autocomplete="email" required>
                @error('email')
                    <div class="text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <input type="password" class="p-2 w-64 rounded ring-1 ring-neutral-600 bg-transparent ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('password') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" name="password" placeholder="Password" autocomplete="new-password" required>
                @error('password')
                    <div class="text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <input type="password" class="w-64 p-2 bg-transparent rounded ring-1 ring-neutral-600 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password" required>
            </div>
            <div class="flex justify-end">
                {{-- google oauth --}}
                {{-- <a href="{{ route('oauth.redirect') }}" class="inline-block px-4 py-2 mr-3 font-bold text-center text-white bg-red-500 rounded shadow w-fit h-fit hover:shadow-lg hover:bg-red-400/90 ring-1 ring-black/5">
                    <i class="material-icons">google</i>
                    Sign in as Google
                </a> --}}
                <x-button.primary type="submit" class="inline-block px-4 py-2 w-fit h-fit" :style="'filled'" data-turbo="false">
                    register
                </x-button.primary>
            </div>
        </form>
    </div>
@endsection
