<div class="container">

    {{-- Most commented posts --}}
    <div class="row">
        <x-card title="{{ __('Most Commented') }}" subtitle="{{ __('What people are currently talking about') }}">
            @slot('items')
                @foreach ($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            @endslot
        </x-card>
    </div>

    {{-- Most active authors --}}
    <div class="row mt-4">
        <x-card title="{{ __('Most Active') }}" subtitle="{{ __('Writers with most posts written') }}">
            @slot('items', collect($mostActive)->pluck('name'))
        </x-card>
    </div>

    {{-- Most active authors last month --}}
    <div class="row mt-4">
        <x-card title="{{ __('Most Active Last Month') }}" subtitle="{{ __('Users with most posts written in the month') }}">
            @slot('items', collect($mostActiveLastMonth)->pluck('name'))
        </x-card>
    </div>
</div>