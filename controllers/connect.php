<?php
require(__ROOT__.'/controllers/Controller.php');
require_once(__ROOT__.'/model/SqliteConnection.php');
require_once (__ROOT__.'/model/User.php');

class ConnectUserController extends Controller{
 
    public function get($request){ 
        $this->render('user_connect_form',[]);
    }

    public function post($request){
        try{
            $SQLiteConnect = SqliteConnection::getInstance()->getConnection();
            //récupérer mail et mdp
            $email = $request["mail"];
            $mdp = $request["mdp"];

            //vérifier si le user existe dans la abse de données
            $stmt = $SQLiteConnect->prepare("SELECT * FROM User WHERE email=:email AND password=:mdp");
           
            //bind the parameters
            $stmt->bindValue(':email',$email,PDO::PARAM_STR);
            $stmt->bindValue(':mdp',$mdp,PDO::PARAM_STR);

            // execute the prepared statement
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                // le compte existe
                //démarrage de la session
                session_start();

                //définition des variables de session
                $_SESSION['idUser'] = $user["idUser"];
                $_SESSION['nom'] = $user["lName"];
                $_SESSION['prenom'] = $user["fName"];
                $_SESSION['dateNaiss'] = $user["birthDate"];
                $_SESSION['sexe'] = $user["gender"];
                $_SESSION['taille'] = $user["size"];
                $_SESSION['poids'] = $user["weight"];
                $_SESSION['mail'] = $email;

                $this->render('user_connect_valid',[]);
            }else{
                // le compte n'existe pas
                $this->render('error',$data=["Mail ou mot de passe incorrect"]);
            }

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

?>
