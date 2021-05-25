@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="">
            <h1>My Posts</h1>
        </div>
    </div>
    <div class="row">

        @forelse($posts as $post)
            <div class="col-xl-12">
                {{ $post->title }} <br>
                {{ $post->content }} <br>

            </div>
            <hr>
        @empty
            <div>
                <h4>No posts</h4>
            </div>
        @endforelse

    </div>

@endsection
