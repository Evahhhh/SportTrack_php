<?php
require_once 'SqliteConnection.php';
require_once 'User.php';
require_once 'Activities.php';
require_once 'Data.php';
require_once 'UserDAO.php';
require_once 'ActivityDAO.php';
require_once 'ActivityEntryDAO.php';


try{
    $SQLiteConnect = SqliteConnection::getInstance()->getConnection();

    UserDAO::getInstance()->deleteAll(); 
    ActivityDAO::getInstance()->deleteAll();
    ActivityEntryDAO::getInstance()->deleteAll();

    $queryUser = "select * from User";
    $queryActivity = "select * from Activities";
    $queryData = "select * from Data";
    $result = $SQLiteConnect->query($queryUser)->fetchAll();
    echo "Vérification de la connection à la base de donnée : ";
    var_dump($result);
    

    $Rom = new User();
    $Sand = new User();
    $Activity1 = new Activities();
    $Activity2 = new Activities();
    $Data1 = new Data();
    $Data2 = new Data();

    $Rom->init(1,"DUPONT","Romain","06/10/1999","M",1.90,68,"dupont.rom1@orange.fr","password1234");
    $Sand->init(2,"CARMAIN","Sandra","19/01/2003","M",1.46,49,"sandcarmain@gmail.com","khenty&co56");
    
    echo "Insertion de deux users : ";
    UserDAO::getInstance()->insert($Rom);
    UserDAO::getInstance()->insert($Sand);
    var_dump($SQLiteConnect->query($queryUser)->fetchAll());

    //get Rom's id in the database
    $query = "SELECT idUser FROM User WHERE email = :mail";
    $stmt = $SQLiteConnect->prepare($query);
    $stmt->bindValue(':mail',$Rom->getEmail(),PDO::PARAM_STR);
    $stmt->execute();
    $idRom = $stmt->fetch();
    $idRom = (int)$idRom["idUser"];

    //get Sand's id in the database
    $query = "SELECT idUser FROM User WHERE email = :mail";
    $stmt = $SQLiteConnect->prepare($query);
    $stmt->bindValue(':mail',$Sand->getEmail(),PDO::PARAM_STR);
    $stmt->execute();
    $idSand = $stmt->fetch();
    $idSand= (int)$idSand["idUser"];
    
    $Activity1->init(1,"Je vais au foot", "21/09/2022","21h00","3h",30,80,110,140, $idRom);
    $Activity2->init(2,"Je vais à la danse", "21/10/2022","09h00","1h",3,90,100,120, $idSand);
    ActivityDAO::getInstance()->insert($Activity1);
    ActivityDAO::getInstance()->insert($Activity2);

    echo "Création des activités : ";
    var_dump($SQLiteConnect->query($queryActivity)->fetchAll());

    //get Rom's Activity id in the database
    $query = "SELECT idAct FROM Activities WHERE idUser = :id";
    $stmt = $SQLiteConnect->prepare($query);
    $stmt->bindValue(':id',$idRom,PDO::PARAM_STR);
    $stmt->execute();
    $idActRom = $stmt->fetch();
    $idActRom = (int)$idActRom["idAct"];

    //get Sand's Activity id in the database
    $query = "SELECT idAct FROM Activities WHERE idUser = :id";
    $stmt = $SQLiteConnect->prepare($query);
    $stmt->bindValue(':id',$idSand,PDO::PARAM_STR);
    $stmt->execute();
    $idActSand = $stmt->fetch();
    $idActSand = (int)$idActSand["idAct"];  

    $Data1->init(1,"9h00",94,1.24, 24.6, 294, $idActRom); 
    $Data2->init(2,"18h00",123, 1.82, 41.9, 300, $idActSand);
    ActivityEntryDAO::getInstance()->insert($Data1);
    ActivityEntryDAO::getInstance()->insert($Data2);

    echo "Création des données : ";
    var_dump($SQLiteConnect->query($queryData)->fetchAll());

    $Data2->init(2,"19h00",110, 5.23, 56.2, 244, $idActSand);
    echo "Modification de la donnée : ";
    ActivityEntryDAO::getInstance()->update($Data2);    
    var_dump($SQLiteConnect->query($queryData)->fetchAll());


    $Sand->init($idSand,"DUPONT","Romain","06/10/1999","M",1.90,68,"dupont.rom2@orange.fr","password1234");
    UserDAO::getInstance()->update($Sand);
    echo "Remplacer les informations de Sandra CARMAIN par celles de Romain DUPONT (sauf id) : ";
    var_dump($SQLiteConnect->query($queryUser)->fetchAll());

    $Activity2->init($idActSand,"Je vais au basket", "11/09/2022","06h00","1h30",50,110,139,159, $idSand);
    echo "Modification de l'activité : ";
    ActivityDAO::getInstance()->update($Activity2);    
    var_dump($SQLiteConnect->query($queryActivity)->fetchAll());

    echo "Suppression de la donnée 1 : ";
    ActivityEntryDAO::getInstance()->delete($Data1);
    var_dump($SQLiteConnect->query($queryData)->fetchAll());

    echo "Suppression de l'activité 1 : ";
    ActivityDAO::getInstance()->delete($Activity1);
    var_dump($SQLiteConnect->query($queryActivity)->fetchAll());

    UserDAO::getInstance()->delete($Rom);
    echo "Suppresion de Romain DUPONT avec l'id 1 : ";
    var_dump($SQLiteConnect->query($queryUser)->fetchAll());

    UserDAO::getInstance()->deleteAll(); 
    ActivityDAO::getInstance()->deleteAll();
    ActivityEntryDAO::getInstance()->deleteAll();
    
}catch(Exception $e){
    echo $e->getMessage();
}


?>