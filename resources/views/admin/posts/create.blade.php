@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="col-md-8">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-pencil"></i> Dados sobre o post
                </div>

                <div class="box-body">
                    {!!
                    form($form->add('insert', 'submit', [
                        'attr' => ['class' => 'btn btn-primary'],
                        'label' => '<i class="fa fa-plus"></i> Cadastrar'
                    ]))
                    !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('.j-select2').select2();
        });
    </script>
@endpush