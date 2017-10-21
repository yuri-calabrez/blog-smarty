<?php

namespace App\Http\Controllers\Admin;

use App\Forms\RoleForm;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Facades\FormBuilder;
use App\Annotations\Mapping as Permissions;

/**
* @Permissions\Controller(name="roles-admin", description="Administração de papéis de usuário")
 */
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @Permissions\Action(name="list", description="Listar papéis de usuários")
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permissions\Action(name="store", description="Cadastrar papéis de usuários")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(RoleForm::class, [
            'method' => 'POST',
            'url' => route('admin.roles.store')
        ]);

        return view('admin.roles.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permissions\Action(name="store", description="Cadastrar papéis de usuários")
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(RoleForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        Role::create($data);
        $request->session()->flash('success', 'Papel de usuário criado com sucesso!');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @Permissions\Action(name="update", description="Editar papéis de usuários")
     * @param Role $role
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Role $role)
    {
        $form = FormBuilder::create(RoleForm::class, [
            'method' => 'PUT',
            'url' => route('admin.roles.update', ['role' => $role->id]),
            'model' => $role
        ]);
        return view('admin.roles.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     * @Permissions\Action(name="update", description="Editar papéis de usuários")
     * @param RoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(RoleRequest $request, Role $role)
    {
        $form = FormBuilder::create(RoleForm::class, [
            'data' => ['id' => $role->id]
        ]);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $request->except('permissions');
        $role->update($data);
        $request->session()->flash('success', 'Papel de usuário editado com sucesso!');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     * @Permissions\Action(name="destroy", description="Remover papéis de usuários")
     * @param Role $role
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Role $role)
    {
        $adminRole = Role::where('name', config('acl.acl.role_admin'))->first();
        if ($adminRole->id == $role->id) {
            \Session::flash('error', 'Este papel de usuário não pode ser removido!');
            return redirect()->back();
        }
        try {
            $role->delete();
            \Session::flash('success', 'Papel de usuário removido com sucesso!');
        } catch (QueryException $e) {
            \Session::flash('error', 'Papel de usuário não pode ser exlcuido. Ele esta relacionado com outros registros.');
        }
        return redirect()->route('admin.roles.index');
    }

    /**
     * @param Role $role
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPermission(Role $role, Permission $permission)
    {
        $permissions = $permission->whereNotNull('resource_name')->get();
        $permissionsGroup = $permission->groupBy('name', 'description')->get(['name', 'description']);
        return view('admin.roles.permissions', compact('role', 'permissions', 'permissionsGroup'));
    }

    public function updatePermission(PermissionRequest $request, Role $role)
    {
        $data = $request->get('permissions', []);
        $role->permissions()->sync($data);
        $request->session()->flash('success', 'Permissões atribuidas com sucesso!');
        return redirect()->route('admin.roles.index');
    }
}
