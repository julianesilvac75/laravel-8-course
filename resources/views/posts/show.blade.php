@extends('layouts.app')

@section('title', $post['title'])

@section('content')

@if ($post['is_new'])
    <div>a new post, using if</div>
@else
    <div>post is old, using elseif/else</div>
@endif

@unless ($post['is_new'])
    <div>it's old, using unless</div>
@endunless

    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>

@isset($post['has_comments'])
    <div>the post has comments, using isset</div>
@endisset
@endsection