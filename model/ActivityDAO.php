<?php
require_once('SqliteConnection.php');
class ActivityDAO {

    private static ActivityDAO $dao;

    private function __construct() {}

    public static function getInstance(): ActivityDAO {
        if(!isset(self::$dao)) {
            self::$dao= new ActivityDAO();
        }
        return self::$dao;
    }

    public final function findAll(): Array{
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Activities order by idAct";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Activities');
        return $results;
    }

    public final function insert(Activities $st): void{
        if($st instanceof Activities){
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "insert into Activities(idAct, description, date, idUser) 
                        values (:idAct, :desc,:date,:idUser)";
            $stmt = $dbc->prepare($query);

            // bind the paramaters
            $stmt->bindValue(':idAct',$st->getIdAct(),PDO::PARAM_STR);
            $stmt->bindValue(':desc',$st->getDescription(),PDO::PARAM_STR);
            $stmt->bindValue(':date',$st->getDate(),PDO::PARAM_STR);
            $stmt->bindValue(':idUser',$st->getIdUser(),PDO::PARAM_STR);

            // execute the prepared statement
            $stmt->execute();
        }
    }

    public function deleteAll(): void { 
        $dbc = SqliteConnection::getInstance()->getConnection();
        try{
            // prepare the SQL statement
            $query = "delete from Activities";
            $stmt = $dbc->prepare($query);
            // execute the prepared statement
            $stmt->execute();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function delete(Activities $obj): void { 
        if($obj instanceof Activities){
            $dbc = SqliteConnection::getInstance()->getConnection();
            try{
                // prepare the SQL statement
                $query = "delete from Activities where idAct = :id";
                $stmt = $dbc->prepare($query);

                // bind the paramaters
                $stmt->bindValue(':id',$obj->getIdAct(),PDO::PARAM_STR);

                // execute the prepared statement
                $stmt->execute();
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
     }

     public function update(Activities $obj): void {
        if($obj instanceof Activities){
            try{
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "update Activities set description=:desc, date=:date, idUser=:idUser
                        where idAct=:idAct";
                $stmt = $dbc->prepare($query);
    
                // bind the paramaters
                $stmt->bindValue(':idAct',$obj->getIdAct(),PDO::PARAM_STR);
                $stmt->bindValue(':desc',$obj->getDescription(),PDO::PARAM_STR);
                $stmt->bindValue(':date',$obj->getDate(),PDO::PARAM_STR);
                $stmt->bindValue(':idUser',$obj->getIdUser(),PDO::PARAM_STR);
    
                // execute the prepared statement
                $stmt->execute();
            }catch(Excpetion $e){
                echo $e->getMessage();
            }
        }
    }
}
?>