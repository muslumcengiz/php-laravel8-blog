@extends('layouts.app')

@section('title', __('Welcome'))
@section('content')
    <div class="container">
        <h1>{{ __('You can no longer login. Your user has been blocked.') }}</h1>
    </div>
@endsection
