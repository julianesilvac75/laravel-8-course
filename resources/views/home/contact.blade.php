@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h1>Contact</h1>
    <p>Hello, this is the contact page!</p>

    @can('home.secret')
        <p>
            <a href="{{ route('home.secret') }}">
                Go to special contact details
            </a>
        </p>
    @endcan
@endsection