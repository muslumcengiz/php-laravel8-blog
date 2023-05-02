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
                    <th>{{ __('Comment') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('User') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($commentsData as $commet)
                    <tr>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.posts.comments.delete', $commet->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')"><i class="fa fa-trash"></i></a>
{{--                            <a href="{{ route('admin.posts.comments.edit', $commet->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>--}}
                            <a href="{{ route('posts.show', $commet->getPost->slug) }}#comments" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
                        </td>
                        <td>{{ $commet->content }}</td>
                        <td class="text-nowrap">{{ date('d.m.Y H:i', strtotime($commet->created_at)) }}</td>
                        <td class="text-nowrap">{{ $commet->getUser->name.' '.$commet->getUser->surname }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $commentsData->links('pagination::bootstrap-4') }}
        </div>
    </div>


@endsection
