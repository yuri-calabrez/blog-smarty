<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = \App\Models\Role::create([
           'name' => config('acl.acl.role_admin'),
           'description' => 'Papel de usuário mestre do sistema'
        ]);

        $user = \App\Models\User::where('email', config('acl.acl.email_admin'))->first();
        $user->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAdmin = \App\Models\Role::where('name', config('acl.acl.role_admin'))->first();
        $user = \App\Models\User::where('email', config('acl.acl.email_admin'))->first();
        $user->roles()->detach($roleAdmin->id);
        $roleAdmin->permissions()->detach();
        $roleAdmin->users()->detach();
        $roleAdmin->delete();

    }
}
