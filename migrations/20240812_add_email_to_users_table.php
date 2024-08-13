<?php

return new class extends Migration {
    public function up($pdo) {
        $query = "ALTER TABLE users ADD COLUMN email VARCHAR(100) NOT null AFTER name;";

        $pdo->exec($query);
        echo "Column 'email' added to 'users' table successfully.\n";
    }

    public function down($pdo) {
        $query = "ALTER TABLE users DROP COLUMN email;";

        $pdo->exec($query);
        echo "Column 'email' removed from 'users' table successfully.\n";
    }
};