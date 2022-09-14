@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <p>Added {{ $post->created_at->diffForHumans() }}</p>

    @if(now()->diffInMinutes($post->created_at) < 20)
        {{-- @component('components.badge', ['type' => 'primary'])
            Brand new!
        @endcomponent --}}

        {{-- @badge(['type' => 'primary'])
            Brand new!
        @endbadge --}}

        <x-badge type="primary">
            Brand new!
        </x-badge>
    @endif

    <h4>Comments</h4>

    @forelse ($post->comments as $comment)
        <p>
            {{ $comment->content }}
        </p>
        <p class="text-muted">
            Added {{ $comment->created_at->diffForHumans() }}
        </p>
    @empty
        <p>No comments yet!</p>
    @endforelse

@endsection