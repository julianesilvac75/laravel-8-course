<div class="mb-2 mt-2">
    @auth
        <form action="#" method="POST">
            @csrf
    
            <div class="form-group">
                <textarea class="form-control" name="content"></textarea>
            </div>
    
            <div>
                <input class="btn btn-primary btn-block" type="submit" value="Add Comment">
            </div>
        </form>
    
    @else
        <p>
            <a href="{{ route('login') }}">Sign-in</a> to post a comment!
        </p>
    @endauth
        <hr>
</div>
