<?php

namespace App\Http\Controllers\Admin;

use App\Forms\UserForm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(12);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(UserForm::class, [
            'method' => 'POST',
            'url' => route('admin.users.store'),
            'data' => ['required' => 'required|']
        ]);

        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(UserForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->roles()->sync($data['roles']);
        $request->session()->flash('success', 'Usuário cadastrado com sucesso!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
           'method' => 'PUT',
           'url' => route('admin.users.update', ['user' => $user->id]),
           'model' => $user->toArray()
        ]);

        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'data' => ['id' => $user->id]
        ]);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        if (!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $user->roles()->sync($data['roles']);
        $request->session()->flash('success', 'Usuário editado com sucesso!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id == \Auth::user()->id) {
            \Session::flash('error', 'Atenção! Você esta tentando remover o seu próprio usuário! Esta ação não é permitida!');
            return redirect()->route('admin.users.edit', ['user' => $user->id]);
        }
        $posts = $user->posts;
        foreach ($posts as $post) {
           $post->tags()->detach();
           $post->delete();
        }
        $user->roles()->detach();
        $user->delete();
        \Session::flash('success', 'Usuário removido com sucesso!');
        return redirect()->route('admin.users.index');
    }
}
