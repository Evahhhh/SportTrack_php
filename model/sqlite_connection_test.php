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

    $Activity1->init(1,"Je vais au foot", "21/09/2022", 1);
    $Activity2->init(2,"Je vais à la danse", "21/10/2022", 2);
    ActivityDAO::getInstance()->insert($Activity1);
    ActivityDAO::getInstance()->insert($Activity2);

    echo "Création des activités : ";
    var_dump($SQLiteConnect->query($queryActivity)->fetchAll());


    $Data1->init(1,"21/09/2022", "1h30", 1.5, 83, 110, 150, 5.22, 43.17, 500, 1);
    $Data2->init(2,"21/10/2022", "3h30", 5.5, 75, 122, 139, 1.82, 41.9, 300, 2);
    ActivityEntryDAO::getInstance()->insert($Data1);
    ActivityEntryDAO::getInstance()->insert($Data2);

    echo "Création des données : ";
    var_dump($SQLiteConnect->query($queryData)->fetchAll());

    $Data2->init(2,"23/10/2022", "1h30", 5.5, 98, 140, 178, 2.92, 42.9, 450, 2);
    echo "Modification de la donnée : ";
    ActivityEntryDAO::getInstance()->update($Data2);    
    var_dump($SQLiteConnect->query($queryData)->fetchAll());


    $Sand->init(2,"DUPONT","Romain","06/10/1999","M",1.90,68,"dupont.rom2@orange.fr","password1234");
    UserDAO::getInstance()->update($Sand);
    echo "Remplacer les informations de Sandra CARMAIN par celles de Romain DUPONT (sauf id) : ";
    var_dump($SQLiteConnect->query($queryUser)->fetchAll());

    $Activity2->init(2,"Je vais au basket", "21/10/2022", 1);
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
    echo "Insertion d'un utilisateur avec un même id (erreur provoquée) : ";
    UserDAO::getInstance()->insert($Sand);
    
}catch(Exception $e){
    echo $e->getMessage();
}


?>