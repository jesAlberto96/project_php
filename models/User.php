<?php

require_once 'Model.php';

class User extends Model {
    public function __construct() {
        parent::__construct('users');
    }

    // Métodos específicos para el modelo User aquí...
    public function emailExists($email) {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    public function emailExistsIgnoreId($email, $id) {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email and id <> :id');
        $stmt->execute(['email' => $email, 'id' => $id]);
        return $stmt->fetchColumn() > 0;
    }
}

