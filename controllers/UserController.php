<?php

require_once 'models/User.php';
require_once 'Response.php';

class UserController {

    public function index() {
        $userModel = new User();
        $users = $userModel->getAll();
        echo json_encode($users);
    }

    public function register() {
        $view = 'views/auth/register.php';
        require 'views/layout.php';
    }

    public function showAll() {
        $userModel = new User();
        $users = $userModel->getAll();
        Response::sendResponse($users ?? false);
    }

    public function show($id) {
        $userModel = new User();
        $user = $userModel->getById($id);
        Response::sendResponse($user ?? false);
    }

    public function create() {
        try {
            $userModel = new User();
            $data = $_POST;

            $errors = validate($data, [
                'name' => 'required',
                'password' => 'required',
                'email' => 'required|email'
            ]);

            // Verifica si el email ya existe
            if ($userModel->emailExists($data['email'])) {
                $errors['email'][] = 'The email has already been taken.';
            }

            if (count($errors) > 0){
                return Response::sendResponse($errors, 400);
            }

            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

            $user = $userModel->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $hashedPassword,
            ]);

            Response::sendResponse($user);
        } catch (\Throwable $th) {
            return Response::sendResponse("Ocurrio un error inesperado", 400);
        }
    }

    public function update($id) {
        try {
            $userModel = new User();
            // $data = $_POST;
            $data = json_decode(file_get_contents('php://input'), true);

            $errors = validate($data, [
                'name' => 'required',
                'email' => 'required|email'
            ]);

            // Verifica si el email ya existe
            if ($userModel->emailExistsIgnoreId($data['email'], $id)) {
                $errors['email'][] = 'The email has already been taken.';
            }

            if (count($errors) > 0){
                return Response::sendResponse($errors, 400);
            }

            $userModel->update($id, $data);
            Response::sendResponse("User edited successfully");
        } catch (\Throwable $th) {
            return Response::sendResponse("Ocurrio un error inesperado", 400);
        }
    }

    public function delete($id) {
        try {
            $userModel = new User();
            $userModel->delete($id);
            Response::sendResponse("User deleted successfully");
        } catch (\Throwable $th) {
            return Response::sendResponse("Ocurrio un error inesperado", 400);
        }
    }
}