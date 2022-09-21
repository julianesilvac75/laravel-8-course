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
    
    {{ trans_choice('messages.comments', $post->comments_count) }}
    
    <div class="mb-3">
        @can('update', $post)
            <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">{{ __('Edit') }}</a>
        @endcan

        @if (!$post->trashed())
            @can('delete', $post)
                <form class="d-inline" action="{{ route('posts.destroy', ['post' =>$post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
        
                    <input class="btn btn-primary" type="submit" value="{{ __('Delete!') }}">
                </form>
            @endcan
        @endif
    </div>
</div>
