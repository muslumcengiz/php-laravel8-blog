@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">{{ $post->title }}</div>

        <div class="card-body">
            @if($post->image)
                <img src="{{ asset($post->image) }}" style="max-height: 250px;max-width: 250px;margin: 5px;float: left">
            @endif
            {{ $post->content,300 }}
            <hr>
            {{ $post->getUser->name.' '.$post->getUser->surname }} |
            <span title="{{ $post->created_at }}">{{ \Carbon\Carbon::createFromDate($post->created_at)->diffForHumans() }}</span> |
            <a href="#comments">{{ count($post->getComments) }} {{ __('Comment') }}</a> |
            @if($post->isILike)
                <a href="{{ route('posts.likes.delete', $post->id) }}">Beğenmekten vazgeç</a>
            @else
                <a href="{{ route('posts.likes.store', $post->id) }}">Beğen</a>
            @endif
             ({{ count($post->getLikes) }} beğenme)
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">{{ __('Write comment')}}</div>

        <div class="card-body">
            @if(\Illuminate\Support\Facades\Session::get('commentSuccess'))
                <p>{{ __('Your comment has been registered.') }}</p>
            @endif
            <form method="POST" action="{{ route('posts.comments.store') }}">
                @csrf
                <input type="hidden" name="postId" value="{{ $post->id }}">
                <div class="mb-3">
                    <textarea rows="3" id="comment" name="comment" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                    @error('comment')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <a id="comments"></a>
    @foreach($post->getComments as $comment)
        <div class="card mb-4">
            <div class="card-header">
                {{ $comment->getUser->name.' '.$comment->getUser->surname }} |
                <span title="{{ $comment->created_at }}">{{ \Carbon\Carbon::createFromDate($comment->created_at)->diffForHumans() }}</span>
            </div>

            <div class="card-body">
                {{ $comment->content }}
            </div>
        </div>
    @endforeach
</div>
@endsection
