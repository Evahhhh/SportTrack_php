<?php
// header
include VIEWS_DIR."/header.html";

foreach ($data as $err) {
    echo $err.'<br>'; // Avec retour à la ligne entre chaque erreur 
}

include VIEWS_DIR."/footer.html";
?>
