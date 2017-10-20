<?php

namespace App\Http\Controllers\Admin;

use App\Forms\UserForm;
use App\Forms\UserPasswordForm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Annotations\Mapping as Permissions;

/**
 * @Permissions\Controller(name="users-admin", description="Administração de usuários")
 */
class UsersController extends Controller
{
    /**
     * @Permissions\Action(name="list", description="Listagem de usuários")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(12);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permissions\Action(name="store", description="Cadastro de usuários")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(UserForm::class, [
            'method' => 'POST',
            'url' => route('admin.users.store'),
            'data' => ['showPassword' => true]
        ]);

        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permissions\Action(name="store", description="Cadastro de usuários")
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'data' => ['showPassword' => true]
        ]);
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
     * @Permissions\Action(name="update-password", description="Atualização de senha")
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword(Request $request, User $user)
    {
        $form = \FormBuilder::create(UserPasswordForm::class, [
            'method' => 'PUT',
            'url' => route('admin.users.password.update', ['user' => $user->id])
        ]);

        return view('admin.users.password', compact('form'));
    }

    /**
     * @Permissions\Action(name="update-password", description="Atualização de senha")
     * @param Request $request
     * @param User $user
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, User $user)
    {
        $form = \FormBuilder::create(UserPasswordForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $user->update(['password' => bcrypt($data['password'])]);
        $request->session()->flash('success', 'Senha alterada com sucesso!');
        return redirect()->route('admin.users.index');

    }

    /**
     * Show the form for editing the specified resource.
     * @Permissions\Action(name="update", description="Editar usuário")
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
           'method' => 'PUT',
           'url' => route('admin.users.update', ['user' => $user->id]),
           'model' => $user
        ]);

        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     * @Permissions\Action(name="update", description="Editar usuário")
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
        $user->update($data);
        $user->roles()->sync($data['roles']);
        $request->session()->flash('success', 'Usuário editado com sucesso!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     * @Permissions\Action(name="destroy", description="Remover usuário")
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
