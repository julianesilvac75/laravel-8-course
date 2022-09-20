<div>
    <h3>
        @if ($post->trashed())
            <del>
        @endif

        <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
            href="{{ route('posts.show', ['post' => $post->id]) }}">
            {{ $post->title }}
        </a>

        @if ($post->trashed())
            </del>
        @endif
    </h3>

    <x-updated :date="$post->created_at" :name="$post->user->name" :userId="$post->user->id"></x-updated>

    <x-tags :tags="$post->tags" />
    
    @if ($post->comments_count)
        <p>{{ $post->comments_count }} comments</p>
    @else
        <p>No comments yet!</p>
    @endif
    
    <div class="mb-3">
        {{-- Apparently, @auth is not necessary anymore on Laravel 8  --}}
        {{-- @auth --}}
            @can('update', $post)
                <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
            @endcan
        {{-- @endauth --}}
        
        {{-- @auth --}}
            @if (!$post->trashed())
                @can('delete', $post)
                    <form class="d-inline" action="{{ route('posts.destroy', ['post' =>$post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
            
                        <input class="btn btn-primary" type="submit" value="Delete">
                    </form>
                @endcan
            @endif
        {{-- @endauth --}}

    </div>
</div>
