<?php

namespace App\Http\Controllers\Admin;

use App\Forms\PostForm;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;
use Image;

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
        /** @var Form $form */
        $form = \FormBuilder::create(PostForm::class);
        if(!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $data['author_id'] = \Auth::user()->id;
        $tags = $data['tags'];
        unset($data['tags']);
        $post = Post::create($data);
        $post->tags()->sync($tags);

        if($request->hasFile('cover')){
            $image = $request->file('cover');
            $imageName = $post->id.'-'.$post->slug.'.'.$image->getClientOriginalExtension();
            $location = public_path('uploads/posts/'.$imageName);
            Image::make($image->getRealPath())->resize(1200, 800)->save($location);
            $post->cover = $imageName;
            $post->save();
        }
        $request->session()->flash('success', 'Post criado com sucesso!');
        return redirect()->route('admin.posts.index');
    }
}
