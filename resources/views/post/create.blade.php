@extends('layouts.app')

@section('title', 'Home')

@section('header_target', 'target')

@section('content')
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card text-bg-800">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12 d-grid gap-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <div class="card text-bg-800">
                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="text" name="title" class="form-control border-700 text-bg-700" placeholder="Title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <textarea name="content" class="simplemde"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-outline-red-600">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-main-500">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
