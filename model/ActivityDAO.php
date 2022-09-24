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
            $query = "insert into Activities(description, date, startTime, duration, distance ,cardiacFreqMin,
            cardiacFreqAvg, cardiacFreqMax, idUser) 
            values (:desc,:date,:start,:dur,:dist,:cFreqMin,:cfreqAVG,:cFreqMax, :idUser)";
            $stmt = $dbc->prepare($query);
            
            // bind the paramaters
            $stmt->bindValue(':desc',$st->getDescription(),PDO::PARAM_STR);
            $stmt->bindValue(':date',$st->getDate(),PDO::PARAM_STR);
            $stmt->bindValue(':start',$st->getStartTime(),PDO::PARAM_STR);
            $stmt->bindValue(':dur',$st->getDuration(),PDO::PARAM_STR);
            $stmt->bindValue(':dist',$st->getDistance(),PDO::PARAM_STR);
            $stmt->bindValue(':cFreqMin',$st->getCardiacFreqMin(),PDO::PARAM_STR);
            $stmt->bindValue(':cfreqAVG',$st->getCardiacFreqAvg(),PDO::PARAM_STR);
            $stmt->bindValue(':cFreqMax',$st->getCardiacFreqMax(),PDO::PARAM_STR);
            $stmt->bindValue(':idUser',$st->getIdUser(),PDO::PARAM_STR);
            
            // execute the prepared statement
            $stmt->execute();
            
            //change the id by the database one
            // prepare the SQL statement
            $query = "SELECT idAct FROM Activities WHERE idUser = :id AND description = :desc AND date = :date
                    AND startTime =:start AND duration=:dur AND distance=:dist AND cardiacFreqMin=:cFreqMin
                    AND cardiacFreqAvg=:cfreqAVG AND cardiacFreqMax=:cFreqMax";
            $stmt = $dbc->prepare($query);
            // bind the paramaters
            $stmt->bindValue(':desc',$st->getDescription(),PDO::PARAM_STR);
            $stmt->bindValue(':date',$st->getDate(),PDO::PARAM_STR);
            $stmt->bindValue(':start',$st->getStartTime(),PDO::PARAM_STR);
            $stmt->bindValue(':dur',$st->getDuration(),PDO::PARAM_STR);
            $stmt->bindValue(':dist',$st->getDistance(),PDO::PARAM_STR);
            $stmt->bindValue(':cFreqMin',$st->getCardiacFreqMin(),PDO::PARAM_STR);
            $stmt->bindValue(':cfreqAVG',$st->getCardiacFreqAvg(),PDO::PARAM_STR);
            $stmt->bindValue(':cFreqMax',$st->getCardiacFreqMax(),PDO::PARAM_STR);
            $stmt->bindValue(':id',$st->getIdUser(),PDO::PARAM_STR);
            // execute the prepared statement
            $stmt->execute();
            $idAct = $stmt->fetch();
            $idAct = (int)$idAct["idAct"];
            //change
            $st->setID($idAct);
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
                $query = "update Activities set description=:desc, date=:date, startTime=:start,
                        duration=:dur,distance=:dist, cardiacFreqMin=:cFreqMin,cardiacFreqAvg=:cfreqAVG,
                        cardiacFreqMax=:cFreqMax, idUser=:idUser where idAct=:idAct";
                $stmt = $dbc->prepare($query);
    
                // bind the paramaters
                $stmt->bindValue(':idAct',$obj->getIdAct(),PDO::PARAM_STR);
                $stmt->bindValue(':desc',$obj->getDescription(),PDO::PARAM_STR);
                $stmt->bindValue(':date',$obj->getDate(),PDO::PARAM_STR);
                $stmt->bindValue(':start',$obj->getStartTime(),PDO::PARAM_STR);
                $stmt->bindValue(':dur',$obj->getDuration(),PDO::PARAM_STR);
                $stmt->bindValue(':dist',$obj->getDistance(),PDO::PARAM_STR);
                $stmt->bindValue(':cFreqMin',$obj->getCardiacFreqMin(),PDO::PARAM_STR);
                $stmt->bindValue(':cfreqAVG',$obj->getCardiacFreqAvg(),PDO::PARAM_STR);
                $stmt->bindValue(':cFreqMax',$obj->getCardiacFreqMax(),PDO::PARAM_STR);
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