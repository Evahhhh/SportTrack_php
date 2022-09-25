<?php include VIEWS_DIR."/header.html"; ?>

<form action="/user_add" method="post">
    <label for="nom">Nom :</label><br>
    <input type="text" id="nom" pattern="^\S+$" name="nom" required><br>

    <label for="prenom">Prénom :</label><br>
    <input type="text" id="prenom" pattern="^\S+$" name="prenom" required><br>

    <label for="datenaiss">Date de naissance :</label><br>
    <input type="date" id="datenaiss" name="datenaiss" required><br>

    <p>Sexe :</p>
    <input type="radio" id="M" name="sexe" value="M" required>
    <label for="M">Masculin</label><br>
    <input type="radio" id="F" name="sexe" value="F" required checked>
    <label for="F">Féminin</label><br>
    <input type="radio" id="NB" name="sexe" value="NB" required>
    <label for="NB">Non binaire</label><br><br>

    <label for="taille">Taille :</label><br>
    <input type="number" id="taille" name="taille" required><br>

    <label for="poids">Poids :</label><br>
    <input type="number" id="poids" name="poids" required ><br>

    <label for="mail">Adresse électronique :</label><br>
    <input type="email" id="mail" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}" name="mail" required onkeyup="javascript:nospaces(this)" onkeydown="javascript:nospaces(this)"><br>

    <label for="mdp">Mot de passe :</label><br>
    <input type="password" id="mdp" name="mdp" minlength="8" required><br><br>

    <input type="submit" value="Créer mon compte">
</form>
            
<?php include VIEWS_DIR."/footer.html"; ?>
