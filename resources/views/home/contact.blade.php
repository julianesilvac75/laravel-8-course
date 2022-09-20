@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h1>{{ __('Contact') }}</h1>
    <p>{{ __('Hello this is contact!') }}</p>

    @can('home.secret')
        <p>
            <a href="{{ route('home.secret') }}">
                Go to special contact details
            </a>
        </p>
    @endcan
@endsection