@extends('layouts.app')

@section('title', $post['title'])

@section('content')

@if ($post['is_new'])
    <div>a new post, using if</div>
@else
    <div>post is old, using elseif/else</div>
@endif

    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>
@endsection