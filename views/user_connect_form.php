<?php include VIEWS_DIR."/header.html"; ?>

<form action="/connect" method="post">
  <label for="mail">Adresse électronique :</label><br>
  <input type="email" id="mail" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}" name="mail" required><br>

  <label for="mdp">Mot de passe :</label><br>
  <input type="password" id="mdp" name="mdp" minlength="8" required><br><br>

  <input type="submit" value="Connexion">
</form>
            
<?php include VIEWS_DIR."/footer.html"; ?>
