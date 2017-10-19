<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RoleForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
       $this->add('name', 'text', [
           'label' => 'Nome',
           'rules' => 'required|max:100|unique:roles,name,'.$id
       ])
       ->add('description', 'text', [
            'label' => 'Descrição'
       ]);

    }
}
