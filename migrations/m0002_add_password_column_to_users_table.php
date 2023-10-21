<?php

use app\core\Application;

class m0002_add_password_column_to_users_table{
    public function up()
    {
       $db = Application::$app->db;
        
       $db->pdo->exec("ALTER TABLE USERS ADD COLUMN password VARCHAR(512) NOT NULL");
    }
    public function down()
    {
        $db = Application::$app->db;
        
        $db->pdo->exec("ALTER TABLE USERS DROP COLUMN PASSWORD");
        
    }
}