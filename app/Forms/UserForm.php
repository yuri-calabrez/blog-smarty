<?php

namespace App\Forms;

use App\Models\Role;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $showPassword = $this->getData('showPassword');

        $this->add('name', 'text', [
            'label' => 'Nome',
            'rules' => 'required|max:255'
        ])
        ->add('email', 'email', [
            'label' => 'E-mail',
            'rules' => "required|email|unique:users,email,{$id}"
        ])
        ->add('roles', 'entity', [
            'label' => 'Papel de usuário',
            'class' => Role::class,
            'multiple' => true,
            'rules' => [
                'required',
                'rules.*' => 'exists:roles,id'
            ]
        ]);

        if($showPassword){
            $this->add('password', 'password', [
                'label' => 'Senha',
                'rules' => "required|max:60"
            ]);
        }
    }
}
