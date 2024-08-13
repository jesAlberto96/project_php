<?php

return new class extends Migration {
    public function up($pdo) {
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            remember_token VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";

        $pdo->exec($query);
        echo "Table 'users' created successfully.\n";
    }

    public function down($pdo) {
        $query = "DROP TABLE IF EXISTS users;";

        $pdo->exec($query);
        echo "Table 'users' dropped successfully.\n";
    }
};