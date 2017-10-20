@extends('layouts.admin')

@section('content')
    <div class="content">
        <a href="{{route('admin.roles.create')}}" title="Novo papel de usuário" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i>
            Novo papel de usuário
        </a>
        <div class="clearfix"></div>

        <div class="panel panel-default" style="margin-top: 15px;">
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Papel de usuário</th>
                        <th>Permissões</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td>
                                    <a href="{{route('admin.roles.permission.edit', ['role' => $role->id])}}"
                                       class="btn btn-warning" title="Permissões">
                                        <i class="fa fa-address-card-o"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('admin.roles.edit', ['role' => $role->id])}}"
                                       class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('admin.roles.destroy', ['role' => $role->id])}}"
                                       class="btn btn-danger" title="Remover"
                                       onclick="event.preventDefault();
                                               document.getElementById('form-role-{{$role->id}}').submit();">
                                        <i class="fa fa-trash"></i></a>

                                    <form action="{{route('admin.roles.destroy', ['role' => $role->id])}}"
                                          id="form-role-{{$role->id}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info text-center">Não existem papeis de usuario. Comece
                                        agora mesmo!
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection