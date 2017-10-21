<?php

namespace App\Http\Controllers\Admin;

use App\Forms\CategoryForm;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;
use App\Annotations\Mapping as Permissions;

/**
 * @Permissions\Controller(name="categories-admin", description="Administração de categorias")
 */
class CategoriesController extends Controller
{

    /**
     * @Permissions\Action(name="list", description="Listagem de categorias")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permissions\Action(name="store", description="Cadastrar categorias")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.store'),
            'method' => 'POST'
        ]);
        return view('admin.categories.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permissions\Action(name="store", description="Cadastrar categorias")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(CategoryForm::class);
        if(!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        Category::create($data);
        $request->session()->flash('success', 'Categoria criada com sucesso!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @Permissions\Action(name="update", description="Editar categorias")
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Category $category)
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.update', ['category' => $category->id]),
            'method' => 'PUT',
            'model' => $category
        ]);
        return view('admin.categories.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     * @Permissions\Action(name="update", description="Editar categorias")
     * @param  \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Category $category)
    {
       $form = \FormBuilder::create(CategoryForm::class);
        if(!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $category->update($data);
        $request->session()->flash('success', 'Categoria editada com sucesso!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @Permissions\Action(name="destroy", description="Remover categorias")
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->posts()->count() >= 1) {
            \Session::flash('error', 'Exitem posts associados a esta categoria. Remova-os pimeiro.');
            return redirect()->route('admin.categories.index');
        }
        $category->delete();
        \Session::flash('success', 'Categoria removida com sucesso!');
        return redirect()->route('admin.categories.index');
    }
}
