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
                return Response::sendResponse('Login successful!');
            }

            return Response::sendResponse('Invalid email or password.');
        } catch (\Throwable $th) {
            return Response::sendResponse("Ocurrio un error inesperado", 400);
        }
    }

    public function logout()
    {
        session_start();
        // Eliminar todas las variables de sesión
        $_SESSION = [];

        // Eliminar la cookie de sesión si existe
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destruir la sesión
        session_destroy();

        // Redirigir al usuario a la página de login
        return Response::sendResponse('Session closed.');
    }
}