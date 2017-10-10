@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="panel panel-default">
            <div class="panel-body">
                {!!
                form($form->add('insert', 'submit', [
                    'attr' => ['class' => 'btn btn-primary'],
                    'label' => '<i class="fa fa-pencil"></i> Editar'
                ]))
                !!}
            </div>
        </div>
    </div>
@endsection