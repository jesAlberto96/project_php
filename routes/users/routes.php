<?php

require_once 'controllers/UserController.php';

return [
    'GET' => [
        'users*' => 'UserController@showAll',
        'users/{id}' => 'UserController@show',
    ],
    'POST' => [
        'users' => 'UserController@create',
    ],
    'PUT' => [
        'users/{id}' => 'UserController@update', // Expecting /user/{id}
    ],
    'DELETE' => [
        'users/{id}' => 'UserController@delete', // Expecting /user/{id}
    ]
];