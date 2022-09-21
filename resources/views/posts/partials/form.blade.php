<div>
    <div class="form-group">
        <label for="title">{{ __('Title') }}</label>
        <input class="form-control" id="title" type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}">
    </div>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group">
        <label for="content">{{ __('Content') }}</label>
        <textarea class="form-control" id="content" name="content">{{ old('content', optional($post ?? null)->content) }}</textarea>
    </div>

    <div class="form-group">
        <label for="thumbnail">{{ __('Thumbnail') }}</label>
        <input class="form-control-file" id="thumbnail" type="file" name="thumbnail">
    </div>

    <x-errors />
</div>
