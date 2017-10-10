<?php

namespace App\Http\Controllers\Admin;

use App\Forms\TagForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(15);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(TagForm::class, [
           'url' => route('admin.tags.store'),
           'method' => 'POST'
        ]);

        return view('admin.tags.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(TagForm::class);
        if(!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors)->withInput();
        }
        $data = $form->getFieldValues();
        Tag::create($data);
        $request->session()->flash('success', 'Tag criada com sucesso!');
        return redirect()->route('admin.tags.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Tag $tag)
    {
        $form = \FormBuilder::create(TagForm::class, [
            'url' => route('admin.tags.update', ['tag' => $tag->id]),
            'method' => 'PUT',
            'model' => $tag
        ]);
        return view('admin.tags.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $form = \FormBuilder::create(TagForm::class);
        if(!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $tag->update($data);
        $request->session()->flash('success', 'Tag editada com sucesso!');
        return redirect()->route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->posts()->detach();
        $tag->delete();
        \Session::flash('success', 'Tag removida com sucesso!');
        return redirect()->route('admin.tags.index');
    }
}
