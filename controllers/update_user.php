<?php 
require(__ROOT__.'/controllers/Controller.php');
require_once (__ROOT__.'/model/User.php');
require_once (__ROOT__.'/model/UserDAO.php');

class UpdateUserController extends Controller{

    public function get($request){
        $this->render('update_user_form',[]);
    } 

    public function post($request){
        try{
            //lancer la session du user
            session_start();

            //vérifier si le user est connecté
            if($_SESSION){
                
                $sexe = $request["sexe"]; 
                $taille = $request["taille"]; 
                $poids = $request["poids"]; 
                $email = $request["mail"];
                $mdp = $request["mdp"]; 


                $us = new User();
                $us->init($_SESSION['idUser'], $_SESSION['nom'],$_SESSION['prenom'], $_SESSION['dateNaiss'],
                            $sexe,$taille,$poids,$email,$mdp);
                UserDAO::getInstance()->update($us);

                //définition des nouvelles variables de session
                $_SESSION['sexe'] = $sexe;
                $_SESSION['taille'] = $taille;
                $_SESSION['poids'] = $poids;
                $_SESSION['mail'] = $email;
                $_SESSION['mdp'] = $mdp;

                $this->render('update_user_valid',[]);
            }else{
                //si aucun user connecté, renvoyer vers la page de connexion
                $this->render('user_connect_form',[]);
            }

        }catch(Exception $e){
            echo $e->getMessage();
        }
            
    }
}
?>