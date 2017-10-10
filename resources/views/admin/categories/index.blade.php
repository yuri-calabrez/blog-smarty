@extends('layouts.admin')

@section('content')
    <div class="content">
        <a href="{{route('admin.categories.create')}}" title="Nova categoria" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i>
            Nova categoria
        </a>
        <div class="clearfix"></div>

        <div class="panel panel-default" style="margin-top: 15px;">
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>
                                    <a href="{{route('admin.categories.edit', ['category' => $category->id])}}"
                                       class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('admin.categories.destroy', ['category' => $category->id])}}"
                                       class="btn btn-danger" title="Remover"
                                       onclick="event.preventDefault();
                                               document.getElementById('form-category-{{$category->id}}').submit();">
                                        <i class="fa fa-trash"></i></a>

                                    <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}"
                                          id="form-category-{{$category->id}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="alert alert-info text-center">Não existem categorias criadas. Comece
                                        agora mesmo!
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {!! $categories->links() !!}
    </div>
@endsection