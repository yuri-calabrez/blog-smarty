@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="" method="GET">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Pesquisar:">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Pesquisar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="{{route('admin.users.create')}}" title="Novo Usuário" class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i>
        Novo Usuário
    </a>
    <div class="clearfix"></div>

    <div class="row">
        @foreach($users as $user)
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img src="/images/no_avatar.jpg" alt="User" class="profile-user-img img-responsive img-circle">
                    <h3 class="profile-username text-center">{{$user->name}}</h3>
                    <p class="text-muted text-center">{{$user->roles->implode('name', ', ')}}</p>
                    <p class="text-muted text-center"><i class="fa fa-envelope"></i> {{$user->email}}</p>
                    <p class="text-muted text-center"><i class="fa fa-calendar-o"></i>
                        Desde de {{$user->created_at->format('d/m/Y')}}
                    </p>
                </div>
                <div class="box-footer text-center">
                    <a href="{{route('admin.users.edit', ['user' => $user->id])}}"
                       title="Gerenciar Admin" class="btn btn-primary"><i class="fa fa-user"></i> Gerenciar</a>
                    <a href="{{route('admin.users.password.edit', ['user' => $user->id])}}"
                       title="Gerenciar Admin" class="btn btn-warning"><i class="fa fa-key"></i> Alterar senha</a>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-md-12 text-center">
            {!! $users->links() !!}
        </div>
    </div>
</div>
@endsection