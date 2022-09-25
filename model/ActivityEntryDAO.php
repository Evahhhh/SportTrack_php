<?php
require_once('SqliteConnection.php');
class ActivityEntryDAO {
    private static ActivityEntryDAO $dao;

    private function __construct() {}
    
    public static function getInstance(): ActivityEntryDAO { 
        if(!isset(self::$dao)) {
        self::$dao= new ActivityEntryDAO();
    }
        return self::$dao;
    }

    public final function findAll(): Array{
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data order by idData";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Data');
        return $results;
    }

    public final function insert(Data $st): void{
        if($st instanceof Data){
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "insert into Data(time, cardiacFreq, longitude, latitude,altitude, idAct) 
                        values (:time,:cardFr,:long,:lat,:alt,:idAct)";
            $stmt = $dbc->prepare($query);

            // bind the paramaters
            $stmt->bindValue(':time',$st->getTime(),PDO::PARAM_STR);
            $stmt->bindValue(':cardFr',$st->getCardiacFreq(),PDO::PARAM_STR);
            $stmt->bindValue(':long',$st->getLongitude(),PDO::PARAM_STR);
            $stmt->bindValue(':lat',$st->getLatitude(),PDO::PARAM_STR);
            $stmt->bindValue(':alt',$st->getAltitude(),PDO::PARAM_STR);
            $stmt->bindValue(':idAct',$st->getIdAct(),PDO::PARAM_STR);

            // execute the prepared statement
            $stmt->execute();

            //change the id by the database one
            // prepare the SQL statement
            $query = "SELECT idData FROM Data WHERE idAct = :id AND time = :t AND cardiacFreq = :cFreq
                    AND longitude =:long AND latitude=:lat AND altitude=:alt";
            $stmt = $dbc->prepare($query);
            // bind the paramaters
            $stmt->bindValue(':t',$st->getTime(),PDO::PARAM_STR);
            $stmt->bindValue(':long',$st->getLongitude(),PDO::PARAM_STR);
            $stmt->bindValue(':lat',$st->getLatitude(),PDO::PARAM_STR);
            $stmt->bindValue(':alt',$st->getAltitude(),PDO::PARAM_STR);
            $stmt->bindValue(':cFreq',$st->getCardiacFreq(),PDO::PARAM_STR);
            $stmt->bindValue(':id',$st->getIdAct(),PDO::PARAM_STR);
            // execute the prepared statement
            $stmt->execute();
            $idData = $stmt->fetch();
            $idData = (int)$idData["idData"];
            //change
            $st->setID($idData);
        }
    }

    public function deleteAll(): void { 
            $dbc = SqliteConnection::getInstance()->getConnection();
            try{
                // prepare the SQL statement
                $query = "delete from Data";
                $stmt = $dbc->prepare($query);
                // execute the prepared statement
                $stmt->execute();
            }catch(Exception $e){
                echo $e->getMessage();
            }
     }

    public function delete(Data $obj): void { 
        if($obj instanceof Data){
            $dbc = SqliteConnection::getInstance()->getConnection();
            try{
                // prepare the SQL statement
                $query = "delete from Data where idData = :idData";
                $stmt = $dbc->prepare($query);

                // bind the paramaters
                $stmt->bindValue(':idData',$obj->getIdData(),PDO::PARAM_STR);

                // execute the prepared statement
                $stmt->execute();
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
     }

    public function update(Data $obj): void {
        if($obj instanceof Data){
            try{
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "update Data set time=:time, cardiacFreq=:cardFr, longitude=:long, 
                        latitude=:lat, altitude=:alt , idAct=:idAct where idData = :idData";
                $stmt = $dbc->prepare($query);
    
                // bind the paramaters
                $stmt->bindValue(':time',$obj->getTime(),PDO::PARAM_STR);
                $stmt->bindValue(':cardFr',$obj->getCardiacFreq(),PDO::PARAM_STR);
                $stmt->bindValue(':long',$obj->getLongitude(),PDO::PARAM_STR);
                $stmt->bindValue(':lat',$obj->getLatitude(),PDO::PARAM_STR);
                $stmt->bindValue(':alt',$obj->getAltitude(),PDO::PARAM_STR);
                $stmt->bindValue(':idAct',$obj->getIdAct(),PDO::PARAM_STR);
    
                // execute the prepared statement
                $stmt->execute();
            }catch(Excpetion $e){
                echo $e->getMessage();
            }
        }
    }
}
?>