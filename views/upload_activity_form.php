<?php include VIEWS_DIR."/header.html"; ?>

<form action="/upload" method="post">
    <label for="activites">Fichier JSON :</label><br><br>
    <input type="file" id="activites" name="activites" accept="application/JSON"><br><br>

    <input type="submit" value="Envoyer le fichier"> 
</form>
            
<?php include VIEWS_DIR."/footer.html"; ?>