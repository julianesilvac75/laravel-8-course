@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <h1>
        {{ $post->title }}

        <x-badge show="{{ now()->diffInMinutes($post->created_at) < 30 }}">
            Brand new!
        </x-badge>

    </h1>

    <p>{{ $post->content }}</p>

    <x-updated :date="$post->created_at" :name="$post->user->name" />
    <x-updated :date="$post->updated_at">
        Updated
    </x-updated>

    <h4>Comments</h4>

    @forelse ($post->comments as $comment)
        <p>
            {{ $comment->content }}
        </p>
       
        <x-updated :date="$comment->created_at" />
    @empty
        <p>No comments yet!</p>
    @endforelse

@endsection