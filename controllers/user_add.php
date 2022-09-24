<?php 
require(__ROOT__.'/controllers/Controller.php');
require_once(__ROOT__.'/model/SqliteConnection.php');

require_once (__ROOT__.'/model/User.php');
require_once (__ROOT__.'/model/UserDAO.php');

class AddUserController extends Controller{

    public function get($request){
        $this->render('user_add_form',[]);
    }

    public function post($request){
        try{
            $SQLiteConnect = SqliteConnection::getInstance()->getConnection();
            $email = $request["mail"];
            $mdp = $request["mdp"];
        
            $stmt = $SQLiteConnect->prepare("SELECT * FROM User WHERE email=:email");
            // bind the paramaters
            $stmt->bindValue(':email',$email,PDO::PARAM_STR);
    
            // execute the prepared statement
            $stmt->execute();
            $user = $stmt->fetch();
             
             if ($user) {
                // email existe
                $this->render('error',$data=["Vous possédez déjà un compte avec cette adresse mail."]);
            } else {
                // email n'existe pas
                $us = new User();
                $us->init(123,$request["nom"],$request["prenom"],$request["datenaiss"],$request["sexe"],
                        floatval($request["taille"]),floatval($request["poids"]),$request["mail"],$request["mdp"]);
                UserDAO::getInstance()->insert($us);

                //get user of the database
                $query = "SELECT * FROM User WHERE email = :mail";
                $stmt = $SQLiteConnect->prepare($query);
                $stmt->bindValue(':mail',$us->getEmail(),PDO::PARAM_STR);
                $stmt->execute();
                $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'User');
                $this->render('user_add_valid',[]);
            }  
        }catch(Exception $e){
            echo $e->getMessage();
        }
            
    }
}

?>