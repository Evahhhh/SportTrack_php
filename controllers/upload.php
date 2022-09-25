<?php
require(__ROOT__.'/controllers/Controller.php');
require_once(__ROOT__.'/model/SqliteConnection.php');
require_once (__ROOT__.'/model/User.php');

class UploadActivityController extends Controller{
 
    public function get($request){ 
        $this->render('upload_activity_form',[]);
    }

    public function post($request){
        try{
            //lancer la session du user
            session_start();

            //vérifier si le user est connecté
            if($_SESSION){
                // Read the JSON file 
                $json = file_get_contents($request["activites"]);
          
                // Decode the JSON file
                $json_data = json_decode($json,true);
                
                // Display data
                print_r($json_data);
    
                //connexion à la bdd
                $SQLiteConnect = SqliteConnection::getInstance()->getConnection();

                //rentrer les données du json dans la bdd
                $act = new Activities();
                $data = new Data();

                // TODO AJOUTER LE CONTENU DU JSON DANS LA BDD
                

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
