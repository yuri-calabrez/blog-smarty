@extends('layouts.admin')

@section('content')
    <div class="content">
        <a href="{{route('admin.posts.create')}}" title="Nova Post" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Novo Post
        </a>
        <div class="clearfix"></div>
        <div class="row">
            @forelse($posts as $post)
            <div class="col-md-3">
                <div class="post-cover-cotainer">
                    @if(!$post->status)
                        <span class="rascunho label label-warning">
                            Rascunho
                        </span>
                    @endif
                    <img src="{{$post->cover ? '/uploads/posts/'.$post->cover : '/images/no_image.jpg'}}"
                         alt="{{$post->title}}" class="img-responsive" width="400">
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                       <h1 class="title">{{str_limit($post->title, 20)}}</h1>
                        <p class="post-cat">{{$post->category->name}}</p>
                        <div class="tags-container">
                            @if($post->tags)
                                @foreach($post->tags as $tag)
                                    <span class="label label-primary">{{$tag->name}}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                        <a href="{{route('admin.posts.destroy', ['post' => $post->id])}}"
                           onclick="event.preventDefault(); document.getElementById('postForm-{{$post->id}}').submit()"
                           class="btn btn-danger"><i class="fa fa-trash"></i> Remover</a>

                        <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="POST"
                              id="postForm-{{$post->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <div class="alert alert-info">Não existem posts criados. Começe agora mesmo!</div>
            @endforelse
        </div>
    </div>
@endsection