<div class="mb-2 mt-2">
    @auth
        <form action="{{ $route }}" method="POST">
            @csrf
    
            <div class="form-group">
                <textarea class="form-control" name="content"></textarea>
            </div>
    
            <div>
                <input class="btn btn-primary btn-block" type="submit" value="{{ __('Add comment') }}">
            </div>
        </form>

        <x-errors />
    
    @else
        <p>
            <a href="{{ route('login') }}">{{ __('Sign-in') }}</a> {{ __('to post comments!') }}
        </p>
    @endauth
        <hr>
</div>
