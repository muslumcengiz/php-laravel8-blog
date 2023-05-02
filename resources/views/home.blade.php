@extends('layouts.app')
@section('title', __('Home'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome.') }}

                        <li><a href="{{route('posts.create')}}">Yeni blog yaz</a></li>
                        <li><a href="{{route('posts')}}" >Bloğu oku</a></li>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
