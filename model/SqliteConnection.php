<?php
class SqliteConnection {

    private static $instance;
    private $pdo;

    
    private function __construct(){
        try{
            $this->pdo = new PDO("sqlite:".__DIR__."/Sport_track.db");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } 
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new SQLiteConnection();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->pdo;
    }    
}
?>