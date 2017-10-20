@extends('layouts.admin')

@section('content')
    <div class="content">
        <h3>Permissões de {{$role->name}}</h3>

        <div class="col-md-12">
            <form action="{{route('admin.roles.permission.update', ['role' => $role->id])}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">

                <ul class="list-group">
                    @foreach($permissionsGroup as $pg)
                    <li class="list-group-item">
                        <h4 class="list-group-heading"><strong>{{$pg->description}}</strong></h4>
                        <p class="list-group-text">
                        <ul class="list-inline">
                            @php
                            $permissionsSubGroup = $permissions->filter(function($value) use ($pg){
                                return $value->name == $pg->name;
                            });
                            @endphp

                            @foreach($permissionsSubGroup as $permission)
                            <li>
                                <div class="checkbox">
                                    <label>
                                        <input {{$role->permissions->contains('id', $permission->id) ? "checked" : ""}}
                                                type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                                > {{$permission->resource_description}}
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        </p>
                    </li>
                    @endforeach
                </ul>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

@endsection