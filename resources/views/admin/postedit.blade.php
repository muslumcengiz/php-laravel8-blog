@extends('admin.mainlayout')
@section('title', __('Blog Posts'))
@section('content')
    <form method="post" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Post Edit') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Title') }}</label>
                    <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-control @error('title') is-invalid @enderror" autofocus>
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Content') }}</label>
                    <textarea rows="10" id="content" name="content" class="form-control @error('content') is-invalid @enderror">{{ $post->content }}</textarea>
                    @error('content')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">{{ __('Old Image') }}</label><br>
                    <img src="{{ asset($post->image) }}" style="max-width: 150px;max-height: 150px;">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">{{ __('New Image') }}</label>
                    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="publish_date" class="form-label">{{ __('Publish date') }} ({{ __('Day/Month/Year') }} Şeklinde yazmalı veya boş bırakmalısınız.)</label>
                    <input type="text" id="publish_date" name="publish_date" value="{{ $post->publish_date?date('d/m/Y', strtotime($post->publish_date)):'' }}" class="form-control @error('publish_date') is-invalid @enderror">
                    @error('publish_date')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <button type="submit" class="btn btn-success">{{__('Save')}}</button>
        </div>
    </div>
    </form>


@endsection
