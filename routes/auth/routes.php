<?php

require_once 'controllers/AuthController.php';

return [
    'GET' => [
        'auth/register' => 'AuthController@register',
        'auth/login' => 'AuthController@loginView',
        'auth/logout' => 'AuthController@logout',
    ],
    'POST' => [
        'auth/login' => 'AuthController@login',
    ]
];