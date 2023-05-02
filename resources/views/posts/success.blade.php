@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Successful') }}</div>

        <div class="card-body">
            {{ __('Transaction performed...') }}
        </div>
    </div>
</div>
@endsection
