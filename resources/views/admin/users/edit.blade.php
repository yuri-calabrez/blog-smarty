@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="col-md-10">
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

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h3 class="text-center">Remover usuário</h3>
                    <a href="{{route('admin.users.destroy', ['user' => $form->getModel()['id']])}}"
                       class="btn btn-danger userRemove"><i class="fa fa-trash"></i> Remover</a>

                    <form id="userForm" action="{{route('admin.users.destroy', ['user' => $form->getModel()['id']])}}"
                          method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('.userRemove').click(function(e){
               e.preventDefault();
                swal({
                    title: 'Você tem certeza?',
                    text: "Não sera possivel reverter esta ação.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim!',
                    cancelButtonText: 'Não!',
                }).then(function () {
                    document.getElementById('userForm').submit();
                })
            });
        });
    </script>
@endpush