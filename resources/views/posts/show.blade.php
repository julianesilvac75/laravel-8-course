@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
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

            <x-tags :tags="$post->tags" />

            <p>Currently read by {{ $counter }} people</p>

            <h4>Comments</h4>

            @forelse ($post->comments as $comment)
                <p>
                    {{ $comment->content }}
                </p>
            
                <x-updated :date="$comment->created_at" :name="$comment->user->name"/>
            @empty
                <p>No comments yet!</p>
            @endforelse
        </div>
        <div class="col-4">
            @include('posts.partials.activity')
        </div>
    </div>
@endsection