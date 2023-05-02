@extends('admin.mainlayout')
@section('title', __('Blog Posts'))
@section('content')
    <form method="post" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
        @method('PUT')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Post Edit') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @csrf

            <div class="row mb-3">
                <label for="status">{{ __('Status') }}</label>
                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                    <option value="1">Aktif</option>
                    <option value="0" @if($user->status==0) selected @endif>Kullanıcıyı engelle</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="userRole">{{ __('User Role') }}</label>
                <select id="userRole" class="form-control @error('userRole') is-invalid @enderror" name="userRole">
                    <option value="">Normal kullanıcı</option>
                    <option value="Admin" @if($user->hasRole('Admin')) selected @endif>Admin Yetkili Kullanıcı</option>
                </select>
                @error('userRole')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="name">{{ __('Surname') }}</label>
                <input id="name" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $user->surname }}" required autocomplete="surname">
                @error('surname')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="name">{{ __('Username') }}</label>
                <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username">
                @error('username')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <button type="submit" class="btn btn-success">{{__('Save')}}</button>
        </div>
    </div>
    </form>


@endsection
