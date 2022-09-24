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
            // Read the JSON file 
            $json = file_get_contents($request["activites"]);
      
            // Decode the JSON file
            $json_data = json_decode($json,true);
            
            // Display data
            print_r($json_data);
            
        }catch(Exception $e){
            echo $e->getMessage();
        }

    }
}

?>
