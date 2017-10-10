<?php

namespace App\Http\Controllers\Admin;

use App\Forms\PostForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {
        $form = \FormBuilder::create(PostForm::class, [
            'method' => 'POST',
            'url' => route('admin.posts.store')
        ]);
        return view('admin.posts.create', compact('form'));
    }

    public function store(Request $request)
    {
        $form = \FormBuilder::create(PostForm::class);
        if(!$form->isValid()) {
            dd($form->getErrors());
        }
        echo "Foi";
    }
}
