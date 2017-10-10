<?php

namespace App\Forms;

use App\Models\Category;
use App\Models\Tag;
use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this->add('title', 'text', [
            'label' => 'Título',
            'rules' => 'required|max:200'
        ])
        ->add('folder', 'file', [
            'label' => 'Capa',
            'rules' => 'nullable|mimes:jpeg,bmp,png'
        ])
        ->add('content', 'textarea', [
            'label' => 'Conteúdo',
            'attr' => ['class' => 'j-tiny-post form-control'],
            'rules' => 'required'
        ])
        ->add('category_id', 'entity', [
            'label' => 'Categoria',
            'class' => Category::class,
            'rules' => 'required|exists:categories,id',
            'empty_value' => 'Selecione uma categoria'
        ])
        ->add('tags', 'entity', [
            'label' => 'Tags',
            'class' => Tag::class,
            'rules' => 'nullable|array',
            'attr' => ['class' => 'select2 form-control'],
            'multiple' => true
        ]);
    }
}
