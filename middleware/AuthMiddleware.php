<?php

class AuthMiddleware {
    public static function handle() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        return true;
    }

    public static function handleRedirect() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: auth/login');
            exit();
        }
    }
}