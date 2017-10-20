<?php

namespace App\Facade;


use App\Annotations\PermissionReader as PermissionReaderService;
use Illuminate\Support\Facades\Facade;

class PermissionReader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PermissionReaderService::class;
    }
}