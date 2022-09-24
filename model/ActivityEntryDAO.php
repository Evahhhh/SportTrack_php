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
            $query = "insert into Data(idData, startTime, duration, distance, cardiacFreqMin, cardiacFreqAvg, 
                                        cardiacFreqMax, longitude, latitude,altitude,idAct) 
                        values (:idData, :start,:durat,:dist,:cardFrMin,:cardFrAVG,:cardFrMax,:long,:lat,:alt,:idAct)";
            $stmt = $dbc->prepare($query);

            // bind the paramaters
            $stmt->bindValue(':idData',$st->getIdData(),PDO::PARAM_STR);
            $stmt->bindValue(':start',$st->getStartTime(),PDO::PARAM_STR);
            $stmt->bindValue(':durat',$st->getDuration(),PDO::PARAM_STR);
            $stmt->bindValue(':dist',$st->getDistance(),PDO::PARAM_STR);
            $stmt->bindValue(':cardFrMin',$st->getCardiacFreqMin(),PDO::PARAM_STR);
            $stmt->bindValue(':cardFrAVG',$st->getCardiacFreqAvg(),PDO::PARAM_STR);
            $stmt->bindValue(':cardFrMax',$st->getCardiacFreqMax(),PDO::PARAM_STR);
            $stmt->bindValue(':long',$st->getLongitude(),PDO::PARAM_STR);
            $stmt->bindValue(':lat',$st->getLatitude(),PDO::PARAM_STR);
            $stmt->bindValue(':alt',$st->getAltitude(),PDO::PARAM_STR);
            $stmt->bindValue(':idAct',$st->getIdAct(),PDO::PARAM_STR);

            // execute the prepared statement
            $stmt->execute();
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
                $query = "update Data set startTime=:start, duration=:durat, distance=:dist, 
                        cardiacFreqMin=:cardFrMin, cardiacFreqAvg=:cardFrAVG, cardiacFreqMax=:cardFrMax,
                        longitude=:long, latitude=:lat, altitude=:alt , idAct=:idAct where idData = :idData";
                $stmt = $dbc->prepare($query);
    
                // bind the paramaters
                $stmt->bindValue(':idData',$obj->getIdData(),PDO::PARAM_STR);
                $stmt->bindValue(':start',$obj->getStartTime(),PDO::PARAM_STR);
                $stmt->bindValue(':durat',$obj->getDuration(),PDO::PARAM_STR);
                $stmt->bindValue(':dist',$obj->getDistance(),PDO::PARAM_STR);
                $stmt->bindValue(':cardFrMin',$obj->getCardiacFreqMin(),PDO::PARAM_STR);
                $stmt->bindValue(':cardFrAVG',$obj->getCardiacFreqAvg(),PDO::PARAM_STR);
                $stmt->bindValue(':cardFrMax',$obj->getCardiacFreqMax(),PDO::PARAM_STR);
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