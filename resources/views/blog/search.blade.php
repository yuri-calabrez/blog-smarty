@extends('layouts.blog')

@section('content')
    @include('blog._posts', ['posts' => $posts, 'col' => ' col-md-6']);
@endsection