@extends('layouts.admin')

@section('content')
    <div class="content">
        <a href="{{route('admin.posts.create')}}" title="Nova Post" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Novo Post
        </a>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-3">
                <div class="post-cover-cotainer">
                    <img src="/images/no_image.jpg" alt="Cover" class="img-responsive" width="400">
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                       <h1 class="title">Titulo</h1>
                        <p class="post-cat">Tecnologia</p>
                        <div class="tags-container">
                            <span class="label label-default">aaa</span>
                            <span class="label label-default">aaa</span>
                            <span class="label label-default">aaa</span>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> Remover</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection