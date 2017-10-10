@extends('layouts.admin')

@section('content')
    <div class="content">
        <a href="{{route('admin.tags.create')}}" title="Nova Tag" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i>
            Nova Tag
        </a>
        <div class="clearfix"></div>

        <div class="panel panel-default" style="margin-top: 15px;">
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Tag</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td>{{$tag->name}}</td>
                                <td>
                                    <a href="{{route('admin.tags.edit', ['tag' => $tag->id])}}"
                                       class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('admin.tags.destroy', ['tag' => $tag->id])}}"
                                       class="btn btn-danger" title="Remover"
                                       onclick="event.preventDefault();
                                               document.getElementById('form-category-{{$tag->id}}').submit();">
                                        <i class="fa fa-trash"></i></a>

                                    <form action="{{route('admin.tags.destroy', ['tag' => $tag->id])}}"
                                          id="form-category-{{$tag->id}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="alert alert-info text-center">Não existem tags criadas. Comece
                                        agora mesmo!
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {!! $tags->links() !!}
    </div>
@endsection