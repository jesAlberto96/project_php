<?php

require_once 'models/User.php';
require_once 'Response.php';

class AuthController {
    public function register()
    {
        $view = 'views/auth/register.php';
        require 'views/layout.php';
    }

    public function loginView()
    {
        $view = 'views/auth/login.php';
        require 'views/layout.php';
    }

    public function login()
    {
        try {
            $data = $_POST;
            $errors = validate($data, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (count($errors) > 0){
                return Response::sendResponse($errors, 400);
            }

            $userModel = new User();
            $user = $userModel->whereFirst(['email' => $data['email']]);

            if ($user && password_verify($data['password'], $user['password'])) {
                // Inicio de sesión exitoso
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                Response::sendResponse('Login successful!');
            } else {
                Response::sendResponse('Invalid email or password.');
            }
        } catch (\Throwable $th) {
            return Response::sendResponse("Ocurrio un error inesperado", 400);
        }
    }

    public function logout()
    {
        $view = 'views/auth/register.php';
        require 'views/layout.php';
    }
}