@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="">
            <h1>Add Post</h1>
        </div>
    </div>
    <div class="row">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <label for="title">Title</label>
            <input type="text" required class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}" name="title" id="title">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="content">Content</label>
            <textarea name="content" required class="form-control @error('content') is-invalid @enderror" id="content"
                rows="5">{{ old('content') }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>

    </div>

@endsection
