<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => config('acl.acl.email_admin'),
            'password' => bcrypt(config('acl.acl.password_admin'))
        ]);
        \Illuminate\Database\Eloquent\Model::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = \App\Models\User::where('email', config('acl.acl.email_admin'))->first();
        $user->forceDelete();
    }
}
