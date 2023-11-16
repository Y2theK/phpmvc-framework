<?php

use Y2thek\PhpMvcframeworkCore\Application;

class m0001_initial{
    public function up()
    {
       $db = Application::$app->db;
        
       $db->pdo->exec("CREATE TABLE USERS (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(199) NOT NULL,
        email VARCHAR(199) NOT NULL,
        status TINYINT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
       ) ENGINE=INNODB;");
    }
    public function down()
    {
        $db = Application::$app->db;
        
        $db->pdo->exec("DROP TABLE USERS");
        
    }
}