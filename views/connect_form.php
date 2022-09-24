<?php include VIEWS_DIR."/header.html"; ?>

<form action="/connect" method="post">
  <label>Prénom :</label><br>
  <input type="text" name="firstname" required><br>
  <label>Nom</label> :<br>
  <input type="text" name="lastname" required><br> 
  <input type="submit" value="Valider"><br>
</form>
            
<?php include VIEWS_DIR."/footer.html"; ?>
