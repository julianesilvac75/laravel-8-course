@extends('layouts.app')

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="form-control" id="name">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" value="{{ old('email') }}" required class="form-control" id="email">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" required class="form-control" id="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Retype Password</label>
            <input type="text" name="password_confirmation" required class="form-control" id="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
@endsection