@forelse ($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>

    <x-tags :tags="$comment->tags" />
    <x-updated :date="$comment->created_at" :name="$comment->user->name" :userId="$comment->user->id"/>

@empty
    <p>{{ trans_choice('messages.comments', 0) }}</p>
@endforelse