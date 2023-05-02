@extends('admin.mainlayout')
@section('title', __('Blog Posts'))
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Blog Posts') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th><i class="fa fa-cogs"></i></th>
                    <th>{{ __('Name & Surname') }}</th>
                    <th>{{ __('Mail') }}</th>
                    <th>{{ __('Date') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usersData as $user)
                    <tr>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.users.delete', $user->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')"><i class="fa fa-trash"></i></a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            @if($user->status==1)
                                <a href="{{ route('admin.users.ban', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-ban" title="Engelle"></i></a>
                            @else
                                <a href="{{ route('admin.users.unban', $user->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check" title="Engeli kaldır"></i></a>
                            @endif
                        </td>
                        <td>{{ $user->name.' '.$user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-nowrap">{{ date('d.m.Y H:i', strtotime($user->created_at)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $usersData->links('pagination::bootstrap-4') }}
        </div>
    </div>


@endsection
