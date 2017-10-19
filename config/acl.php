<?php

return [
    'acl' => [
        'role_admin' => env('ROLE_ADMIN', 'Admin'),
        'email_admin' => env('EMAIL_ADMIN', 'admin@user.com'),
        'password_admin' => env('PASSWORD_ADMIN', '123456'),
        'controllers_annotations' => [
            __DIR__.'/../app/Http/Controllers'
        ]
    ]
];