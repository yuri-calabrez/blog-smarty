@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-pencil"></i> Dados sobre o post
                </div>

                <div class="box-body">
                    {!!
                    form($form->add('insert', 'submit', [
                        'attr' => ['class' => 'btn btn-primary'],
                        'label' => '<i class="fa fa-pencil"></i> Editar'
                    ]))
                    !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(function () {
            $('.j-select2').select2();
            tinymce.init({
                selector:'textarea',
                language: 'pt_BR',
                menubar: false,
                entity_encoding: "raw",
                plugins: [
                    "link image lists preview hr anchor pagebreak",
                    "wordcount visualblocks",
                    "contextmenu directionality paste media"
                ],
                toolbar: "styleselect | forecolor | backcolor | pastetext | removeformat |  bold | italic | underline | strikethrough | bullist | numlist | alignleft | aligncenter | alignright |  link | unlink | image | media |  outdent | indent | preview | code",
                style_formats: [
                    {title: 'Normal', block: 'p'},
                    {title: 'Titulo 3', block: 'h3'},
                    {title: 'Titulo 4', block: 'h4'},
                    {title: 'Titulo 5', block: 'h5'},
                    {title: 'Código', block: 'pre', classes: 'brush: php;'}
                ],
                setup: function(editor){
                    editor.getElement().removeAttribute('required');
                },
                extended_valid_elements: "a[href|target=_blank|rel|class]",
                relative_urls: false,
                remove_script_host: false,
                paste_as_text: true
            });
        });
    </script>
@endpush