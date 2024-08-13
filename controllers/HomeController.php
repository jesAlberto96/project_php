<?php

require_once 'models/User.php';

// function home() {
//     $user = new User();
//     $users = $user->getAll();
//     $view = 'views/home.php';
//     require 'views/layout.php';
// }


class HomeController {
    public function index()
    {
        $user = new User();
        $users = $user->getAll();
        $view = 'views/home.php';
        require 'views/layout.php';
    }
}