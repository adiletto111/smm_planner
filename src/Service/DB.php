<?php  

namespace App\Service;

class DB
{
    private static $pdo;

    public static function get()
    {
        if (is_null(self::$pdo)) {
            $host = 'localhost';
            $db   = 'project_smmplanner';
            $user = 'root';
            $pass = 'root';
            $charset = 'utf8';
            
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $opt = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            self::$pdo = new \PDO($dsn, $user, $pass, $opt);
            
        
        }

        return self::$pdo;
    }
}