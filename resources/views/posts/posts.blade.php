@extends('layouts.app')
@section('title', __('Blog Posts'))
@section('content')
<div class="container">
    @foreach($postsData as $post)
        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </div>

            <div class="card-body">
                @if($post->image)
                    <img src="{{ asset($post->image) }}" style="max-height: 100px;max-width: 100px;margin: 5px;float: left">
                @endif
                {{ \Illuminate\Support\Str::limit($post->content,300) }}
                <hr>
                {{ $post->getUser->name.' '.$post->getUser->surname }} |
                {{ \Carbon\Carbon::createFromTimestamp('Y-m-d H:i:s', $post->created_ad)->diffForHumans() }}
            </div>
        </div>
    @endforeach

    <hr>

    <div class="row">
        {{ $postsData->links('pagination::bootstrap-4') }}
    </div>

</div>
@endsection
