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
        ->add('cover', 'file', [
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
            'attr' => ['class' => 'j-select2 form-control'],
            'multiple' => true
        ])
        ->add('status', 'choice', [
            'choices' => ['0' => 'Sim', '1' => 'Não'],
            'choice_options' => [
                'wrapper' => ['class' => 'choice-wrapper'],
                'label_attr' => ['class' => 'label-class'],
            ],
            'rules' => 'required',
            'label' => 'Salvar como rascunho?',
            'expanded' => true,
            'multiple' => false
        ]);
    }
}
