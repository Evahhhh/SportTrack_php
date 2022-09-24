<?php
require_once('SqliteConnection.php');
class UserDAO {
    private static UserDAO $dao;

    private function __construct() {}

    public static function getInstance(): UserDAO {
        if(!isset(self::$dao)) {
            self::$dao= new UserDAO();
        }
        return self::$dao;
    }

    public final function findAll(): Array{
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from User order by idUser";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'User');
        return $results;
    }

    public final function insert(User $st): void{
        if($st instanceof User){
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "insert into User(lName, fName, birthDate, gender, size, weight, email, password) 
                        values (:lN,:fN,:bd,:g,:s,:w,:mail,:pw)";
            $stmt = $dbc->prepare($query);

            // bind the paramaters
            $stmt->bindValue(':lN',$st->getLName(),PDO::PARAM_STR);
            $stmt->bindValue(':fN',$st->getFName(),PDO::PARAM_STR);
            $stmt->bindValue(':bd',$st->getBirthDate(),PDO::PARAM_STR);
            $stmt->bindValue(':g',$st->getGender(),PDO::PARAM_STR);
            $stmt->bindValue(':s',$st->getSize(),PDO::PARAM_STR);
            $stmt->bindValue(':w',$st->getWeight(),PDO::PARAM_STR);
            $stmt->bindValue(':mail',$st->getEmail(),PDO::PARAM_STR);
            $stmt->bindValue(':pw',$st->getPassword(),PDO::PARAM_STR);

            // execute the prepared statement
            $stmt->execute();
            // User::setId($stmt);
        }
    }

    public function deleteAll(): void { 
            $dbc = SqliteConnection::getInstance()->getConnection();
            try{
                // prepare the SQL statement
                $query = "delete from User";
                $stmt = $dbc->prepare($query);
                // execute the prepared statement
                $stmt->execute();
            }catch(Exception $e){
                echo $e->getMessage();
            }
     }

    public function delete(User $obj): void { 
        if($obj instanceof User){
            $dbc = SqliteConnection::getInstance()->getConnection();
            try{
                // prepare the SQL statement
                $query = "delete from User where idUser = :id";
                $stmt = $dbc->prepare($query);

                // bind the paramaters
                $stmt->bindValue(':id',$obj->getID(),PDO::PARAM_STR);

                // execute the prepared statement
                $stmt->execute();
            }catch(Exception $e){
                echo $e->getMessage();
            }
            
        }
     }

    public function update(User $obj): void {
        if($obj instanceof User){
            try{
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "update User set lName=:lN,fName=:fN, birthDate=:bd, gender=:g, size=:s, 
                        weight=:w, email=:mail, password=:pw where idUser = :id";
                $stmt = $dbc->prepare($query);
    
                // bind the paramaters
                $stmt->bindValue(':id',$obj->getID(),PDO::PARAM_STR);
                $stmt->bindValue(':lN',$obj->getLName(),PDO::PARAM_STR);
                $stmt->bindValue(':fN',$obj->getFName(),PDO::PARAM_STR);
                $stmt->bindValue(':bd',$obj->getBirthDate(),PDO::PARAM_STR);
                $stmt->bindValue(':g',$obj->getGender(),PDO::PARAM_STR);
                $stmt->bindValue(':s',$obj->getSize(),PDO::PARAM_STR);
                $stmt->bindValue(':w',$obj->getWeight(),PDO::PARAM_STR);
                $stmt->bindValue(':mail',$obj->getEmail(),PDO::PARAM_STR);
                $stmt->bindValue(':pw',$obj->getPassword(),PDO::PARAM_STR);
    
                // execute the prepared statement
                $stmt->execute();
            }catch(Excpetion $e){
                echo $e->getMessage();
            }
        }
    }
}
?>