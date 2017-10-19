<?php

namespace App\Annotations\Mapping;

/**
 * Class Action
 * @Annotation
 * @Target("METHOD")
 */
class Action
{
    public $name;
    public $description;
}