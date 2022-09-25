<?php
require(__ROOT__.'/controllers/Controller.php');
require_once (__ROOT__.'/model/User.php');
require_once (__ROOT__.'/model/UserDAO.php');

class ConnectUserController extends Controller{
 
    public function get($request){ 
        $this->render('user_connect_form',[]);
    }

    public function post($request){
        try{
            //récupérer mail et mdp du formualaire
            $email = $request["mail"];
            $mdp = $request["mdp"];

            //vérifier si le user existe dans la base de données
            $exist = false;
            $userAll = UserDAO::getInstance()->findAll();    //Rescence tout les user par id

            foreach ($userAll as $key => $value) {      //key = un user $value = ses infos
                $tab = explode(' ',$value);             //convertir la ligne de valeurs en un tableau de valeurs pour chaque user
                $mail = $tab[7];                        //récupérer le mail du user
                $passw = $tab[8];                       //récupérer le mot de passe du user
                if($email==$mail and $mdp==$passw){     //si le mail du user actuel et le mot de passe sont les même que celui qui veux se connecter : exist = true
                    $exist = true;
                    $infs = $tab;                       //suavegarder les infos du user pour la session
                }
            }

            if ($exist) {
                // le compte existe
                //démarrage de la session
                session_start();

                //définition des variables de session
                $_SESSION['idUser'] = $infs[0];
                $_SESSION['prenom'] = $infs[1];
                $_SESSION['nom'] = $infs[2];
                $_SESSION['dateNaiss'] = $infs[3];
                $_SESSION['sexe'] = $infs[4];
                $_SESSION['taille'] = $infs[5];
                $_SESSION['poids'] = $infs[6];
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
