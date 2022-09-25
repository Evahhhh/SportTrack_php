<?php 
require(__ROOT__.'/controllers/Controller.php');
require_once (__ROOT__.'/model/User.php');
require_once (__ROOT__.'/model/UserDAO.php');

class AddUserController extends Controller{

    public function get($request){
        $this->render('user_add_form',[]);
    } 

    public function post($request){
        try{
            $email = $request["mail"];                  //récupérer le mail du mail entré dans le formulaire
            $exist = false;
            $userAll = UserDAO::getInstance()->findAll();    //Rescence tout les user par id

            foreach ($userAll as $key => $value) {      //key = un user $value = ses infos
                $tab = explode(' ',$value);             //convertir la ligne de valeurs en un tableau de valeurs pour chaque user
                $mail = $tab[7];                        //récupérer le mail du user
                if($email==$mail){                      //si le mail du user actuel est le même que celui qui veux s'inscire : exist = true
                    $exist = true;
                }
            }
             
             if ($exist) {
                // email existe
                $this->render('error',$data=["Vous possédez déjà un compte avec cette adresse mail."]);
            } else {
                // email n'existe pas
                $us = new User();
                $us->init(123,$request["nom"],$request["prenom"],$request["datenaiss"],$request["sexe"],
                        floatval($request["taille"]),floatval($request["poids"]),$email,$request["mdp"]);
                UserDAO::getInstance()->insert($us);
                
                $this->render('user_add_valid',[]);
            }  
        }catch(Exception $e){
            echo $e->getMessage();
        }
            
    }
}

?>