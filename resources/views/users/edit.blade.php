@extends('layouts.app')

@section('content')

    <form action="{{ route('users.update', ['user' => $user->id]) }}"
        method="POST" enctype="multipart/form-data"
        class="form-horizontal">

        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <img src="{{ $user->image ? $user->image->url() : '' }}" alt="thumbnail" class="img-thumbnail avatar">

                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input type="file" name="avatar" class="form-control-file">
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="form-control" value="" type="text" id="name" name="name">
                </div>

                <x-errors></x-errors>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </div>
        </div>

    </form>

@endsection