<?php 
require(__ROOT__.'/controllers/Controller.php');
require_once (__ROOT__.'/model/Activities.php');
require_once (__ROOT__.'/model/ActivityDAO.php');

class ListActivityController extends Controller{

    public function get($request){
        try{
            //lancer la session du user
            session_start();

            //vérifier si le user est connecté
            if($_SESSION){
                $acts = array();
                $actAll = ActivityDAO::getInstance()->findAll(); 
                foreach ($actAll as $key => $value) {      //key = une activité $value = ses infos
                    if($value->getIdUser() == $_SESSION['idUser']){
                        $data = array(
                            $value->getDescription(),
                            $value->getDate(),
                            $value->getStartTime(),
                            $value->getDuration(),
                            $value->getDistance(),
                            $value->getCardiacFreqMin(),
                            $value->getCardiacFreqAvg(),
                            $value->getCardiacFreqMax());
                    } 
                    array_push($acts,$data);
                } 

                $this->render('list_activities',$acts);
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