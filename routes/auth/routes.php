<?php

require_once 'controllers/AuthController.php';

return [
    'GET' => [
        'auth/register' => 'AuthController@register',
        'auth/login' => 'AuthController@loginView',
    ],
    'POST' => [
        'auth/login' => 'AuthController@login',
        'auth/logout' => 'AuthController@logout',
    ]
];