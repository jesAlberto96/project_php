<?php

require_once 'controllers/HomeController.php';

return [
    'GET' => [
        '' => 'HomeController@index',
        'home' => 'HomeController@index',
    ]
];