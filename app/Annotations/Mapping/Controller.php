<?php


namespace App\Annotations\Mapping;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Controller
{
    public $name;
    public $description;
}