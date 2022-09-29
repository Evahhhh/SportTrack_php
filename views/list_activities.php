<?php include VIEWS_DIR."/header.html"; ?>
<table>

<caption>Vos activités</caption>

<tr> <th>Description</th> <th>Date</th> <th>Heure de départ</th> <th>Durée</th> 
   <th>Distance</th> <th>Fréquence cardiaque minimum</th> <th>Moyenne de fréquence cardiaque</th>
   <th>Fréquence cardiaque maximum</th></tr>

<?php
foreach ($data as $activity) {
    ?>
    
    <tr> <td><?php echo($activity[0]) ?></td> <td><?php echo($activity[1]) ?></td> <td><?php echo($activity[2]) ?></td>
    <td><?php echo($activity[3]) ?></td> <td><?php echo($activity[4]." km") ?></td> <td><?php echo($activity[5]) ?></td>
    <td><?php echo($activity[6]) ?></td> <td><?php echo($activity[7]) ?></td></tr>
    
    <?php
}?>

</table>

<?php include VIEWS_DIR."/footer.html"; ?>