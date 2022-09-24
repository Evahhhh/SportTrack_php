<?php
require(__ROOT__.'/controllers/Controller.php');
require_once(__ROOT__.'/model/SqliteConnection.php');
require_once (__ROOT__.'/model/User.php');

class DisconnectUserController extends Controller{
 
    public function get($request){ 
        session_start();
        if($_SESSION){
            session_destroy();
            $this->render('user_disconnect',[]);
        }else{
            $this->render('error',["Vous n'êtes actuellement pas connecté"]);
        }
    }
}
?>