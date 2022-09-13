@extends('layouts.app')

@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" value="{{ old('email') }}"
                required class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
            >

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password"
                required class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
            >

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                    id="remember" {{ old('remember') ? 'checked' : '' }}
                >
                <label class="form-check-label" for="remember"> Remember Me</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
@endsection