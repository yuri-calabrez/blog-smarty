<?php

namespace App\Http\Controllers\Admin;

use App\Forms\PostForm;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;
use Image;
use Mews\Purifier\Facades\Purifier;
use App\Annotations\Mapping as Permissions;

/**
 * @Permissions\Controller(name="posts-admin", description="Administração de posts")
 */
class PostsController extends Controller
{
    /**
     * @Permissions\Action(name="list", description="Listagem de posts")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('author_id', \Auth::user()->id)->paginate(12);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * @Permissions\Action(name="store", description="Cadastrar posts")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $form = \FormBuilder::create(PostForm::class, [
            'method' => 'POST',
            'url' => route('admin.posts.store')
        ]);
        return view('admin.posts.create', compact('form'));
    }

    /**
     * @Permissions\Action(name="store", description="Cadastrar posts")
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(PostForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $data['content'] = Purifier::clean($data['content'], 'youtube');
        $data['author_id'] = \Auth::user()->id;
        $post = Post::create($data);
        $post->tags()->sync($data['tags']);

        if ($request->hasFile('cover')) {
            $this->sendCover($post, $request);
        }
        $request->session()->flash('success', 'Post criado com sucesso!');
        return redirect()->route('admin.posts.index');
    }

    /**
     * @Permissions\Action(name="update", description="Editar posts")
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        $form = \FormBuilder::create(PostForm::class, [
            'method' => 'PUT',
            'url' => route('admin.posts.update', ['post' => $post->id]),
            'model' => $post
        ]);
        return view('admin.posts.edit', compact('form'));
    }

    /**
     * @Permissions\Action(name="update", description="Editar posts")
     * @param Request $request
     * @param Post $post
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        /** @var Form $form */
        $form = \FormBuilder::create(PostForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $data['content'] = Purifier::clean($data['content'], 'youtube');
        if(isset($data['author_id'])){
            unset($data['author_id']);
        }
        $post->update($data);
        $post->tags()->sync($data['tags']);
        if ($request->hasFile('cover')) {
            $this->sendCover($post, $request);
        }

        $request->session()->flash('success', 'Post editado com sucesso!');
        return redirect()->route('admin.posts.index');
    }

    /**
     * @Permissions\Action(name="destroy", description="Remover posts")
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        if (file_exists(public_path('uploads/posts/' . $post->cover)) &&
            !is_dir(public_path('uploads/posts/' . $post->cover))) {
            unlink(public_path('uploads/posts/' . $post->cover));
        }
        $post->tags()->detach();
        $post->delete();
        \Session::flash('success', 'Post removido com sucesso!');
        return redirect()->route('admin.posts.index');
    }


    private function sendCover(Post $post, Request $request)
    {
        if (file_exists(public_path('uploads/posts/' . $post->cover)) &&
            !is_dir(public_path('uploads/posts/' . $post->cover))) {
            unlink(public_path('uploads/posts/' . $post->cover));
        }
        $image = $request->file('cover');
        $imageName = $post->id . '-' . $post->slug . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads/posts/' . $imageName);
        Image::make($image->getRealPath())->resize(1200, 800)->save($location);
        $post->cover = $imageName;
        $post->save();
    }
}
