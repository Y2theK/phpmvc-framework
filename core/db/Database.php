<?php

namespace app\core\db;

use app\core\Application;

class Database{

    public \PDO $pdo;
    public function __construct($config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];
        $this->pdo = new \PDO($dsn,$user,$password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }
    public function applyMigrations()
    {
        $this->createMigrationTable();

        $appliedMigration = $this->getAppliedMigrations();

        $files = scandir(Application::$ROOT_DIR . '/migrations');

        $toApplyMigration = array_diff($files,$appliedMigration);

        $newMigrations = [];
        foreach ($toApplyMigration as $migration) {
            if($migration == '.' || $migration == '..'){
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;

            $className = pathinfo($migration,PATHINFO_FILENAME);

           
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");

            $newMigrations[] = $migration;
            
           
        }

        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }else{
            $this->log("All migrations are applied");
        }

    }
    public function createMigrationTable(){
        $this->pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        ");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare(
            "SELECT migration FROM migrations "
        );

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN); //fetch column will return every migration column in single dimensional array

        
    }
    public function saveMigrations(array $migrations)
    {
        $str = implode(',',array_map(fn($m) => "('$m')",$migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");

        $statement->execute();
    }

    protected function log($message){
        echo '[' . date('Y m d H:i:s') . ' ] ---- ' . $message . PHP_EOL;
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }
}