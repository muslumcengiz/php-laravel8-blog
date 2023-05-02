@extends('layouts.app')
@section('title', __('Create Blog Post'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Create Blog Post') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Title') }}</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" autofocus>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Content') }}</label>
                    <textarea rows="10" id="content" name="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">{{ __('Image') }}</label>
                    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="publish_date" class="form-label">{{ __('Publish date') }} ({{ __('Day/Month/Year') }} Şeklinde yazmalı veya boş bırakmalısınız.)</label>
                    <input type="text" id="publish_date" name="publish_date" value="{{ old('publish_date') }}" class="form-control @error('publish_date') is-invalid @enderror">
                    @error('publish_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
