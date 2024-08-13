<?php

class Model {
    protected $table;

    public function __construct($table) {
        global $pdo;
        $this->pdo = $pdo;
        $this->table = $table;
    }

    // Obtener todos los registros
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    // Obtener un registro por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function whereAll(array $conditions) {
        $sql = "SELECT * FROM {$this->table} WHERE ";
        $params = [];
        $clauses = [];

        foreach ($conditions as $field => $value) {
            $clauses[] = "{$field} = :{$field}";
            $params[$field] = $value;
        }

        $sql .= implode(' AND ', $clauses);

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function whereFirst(array $conditions) {
        $sql = "SELECT * FROM {$this->table} WHERE ";
        $params = [];
        $clauses = [];

        foreach ($conditions as $field => $value) {
            $clauses[] = "{$field} = :{$field}";
            $params[$field] = $value;
        }

        $sql .= implode(' AND ', $clauses);
        $sql .= ' limit 1';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo registro
    public function create($data) {
        $keys = implode(", ", array_keys($data));
        $values = implode(", ", array_fill(0, count($data), "?"));

        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($keys) VALUES ($values)");
        $stmt->execute(array_values($data));

        $id = $this->pdo->lastInsertId();
        return $this->getById($id);
    }

    // Actualizar un registro por ID
    public function update($id, $data) {
        $fields = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));

        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET $fields WHERE id = ?");
        $stmt->execute(array_merge(array_values($data), [$id]));
        return $stmt->rowCount();
    }

    // Eliminar un registro por ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
