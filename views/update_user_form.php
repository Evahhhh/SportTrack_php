<?php 
try{
        session_start();
        if($_SESSION){
        include VIEWS_DIR."/header.html"; 
?>
                <form action="/update_user" method="post">
                        <label for="nom">Nom :</label><br>
                        <input type="text" id="nom" pattern="^\S+$" name="nom" value="<?php  echo($_SESSION["nom"])?>" disabled><br>

                        <label for="prenom">Prénom :</label><br>
                        <input type="text" id="prenom" pattern="^\S+$" name="prenom" value="<?php  echo($_SESSION["prenom"])?>" disabled><br>

                        <label for="datenaiss">Date de naissance :</label><br>
                        <input type="date" id="datenaiss" name="datenaiss" value="<?php  echo($_SESSION["dateNaiss"])?>" disabled><br>

                        <p>Sexe :</p>
                        <input type="radio" id="masc" name="sexe" value="M" value="1" <?php if($_SESSION['sexe'] == 'M'){ echo 'checked';}?>>
                        <label for="masc">Masculin</label><br>
                        <input type="radio" id="fem" name="sexe" value="F" value="2" <?php if($_SESSION['sexe'] == 'F'){ echo 'checked';}?>>
                        <label for="fem">Féminin</label><br>
                        <input type="radio" id="nb" name="sexe" value="NB" value="3" <?php if($_SESSION['sexe'] == 'NB'){ echo 'checked';}?>> 
                        <label for="nb">Non binaire</label><br><br>

                        <label for="taille">Taille :</label><br>
                        <input type="number" id="taille" name="taille" value="<?php  echo($_SESSION["taille"])?>" ><br>

                        <label for="poids">Poids :</label><br>
                        <input type="number" id="poids" name="poids" value="<?php  echo($_SESSION["poids"])?>" ><br>

                        <label for="mail">Adresse électronique :</label><br>
                        <input type="email" id="mail" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}" name="mail" value="<?php  echo($_SESSION["mail"])?>"><br>

                        <label for="mdp">Mot de passe :</label><br>
                        <input type="password" id="mdp" name="mdp" minlength="8" value="<?php  echo($_SESSION["mdp"])?>"><br><br>

                        <input type="submit" value="Enregistrer les modifications">
                </form>

<?php
        }else{
                $this->render('user_connect_form',[]);
        }
}catch(Exception $e){
        echo $e->getMessage();
}

include VIEWS_DIR."/footer.html"; ?>
