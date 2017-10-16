<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $required = $this->getData('required');

        $this->add('name', 'text', [
            'label' => 'Nome',
            'rules' => 'required|max:255'
        ])
        ->add('email', 'email', [
            'label' => 'E-mail',
            'rules' => "required|email|unique:users,email,{$id}"
        ])
        ->add('password', 'password', [
            'label' => 'Senha',
            'rules' => "{$required}max:60"
        ]);
    }
}
