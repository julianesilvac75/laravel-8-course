@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <div class="row">
        {{-- Blog posts list --}}
        <div class="col-8">
            @forelse ($posts as $key => $post)
                @include('posts.partials.post')
            @empty
                <div>No blog posts yet!</div>
            @endforelse
        </div>

        {{-- Right side boxes --}}
        <div class="col-4">
            @include('posts.partials.activity')
        </div>
    </div>

@endsection