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
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th title="{{ __('Comment count') }}">{{ __('c.c') }}</th>
                    <th>{{ __('User') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($postsData as $post)
                    <tr>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.posts.delete', $post->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')"><i class="fa fa-trash"></i></a>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
                        </td>
                        <td>{{ $post->title }}</td>
                        <td class="text-nowrap">{{ date('d.m.Y H:i', strtotime($post->created_at)) }}</td>
                        <td>{{ count($post->getComments) }}</td>
                        <td class="text-nowrap">{{ $post->getUser->name.' '.$post->getUser->surname }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $postsData->links('pagination::bootstrap-4') }}
        </div>
    </div>


@endsection
