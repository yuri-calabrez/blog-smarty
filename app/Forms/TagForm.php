<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TagForm extends Form
{
    public function buildForm()
    {
       $this->add('name', 'text', [
          'label' => 'Tag',
          'rules' => 'required|max:200'
       ]);
    }
}
