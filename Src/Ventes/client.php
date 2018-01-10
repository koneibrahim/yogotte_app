<?php
	 		/* -----Debut Liste.php----------- */
	include'../../Layout/header.php';
    	   echo '<div id="logosahel">';
    		 	  echo'<img src="../../Images/sahel.png" width="100%" height="100%" alt="">';
    		 echo '</div>';
    		 echo '<div id="logoyogo">';
    		 	  echo'<img src="../../Images/yogotte.jpg" width="100%" height="100%" alt="">';
    		echo '</div>';
    	include'../../Layout/header2.php';
            	//include'CRUD.php';
              include'listevente.php';
        echo'<div id="cont">';
            	echo'<h3 class="titrecform textcen">Liste des clients</h3><br/>';
      	echo'<table cellpadding="3" border="0" class="w90">';
            	echo'<tr class="thajouter">';
                	echo'<th colspan="7" class="textdro thtable"><a href="Fajouter.php">
                	<img src="/Images/ajouter.png" width="25px"height="25px" class="img" title="Ajouter"></a></th>';
            	echo'</tr>';
            	echo'<tr class="cth">';
                	echo'<th class="thtable textcen">N°</th>';
                	echo'<th class="thtable textgau">Nom client</th>';
                	echo'<th class="thtable textcen">Téléphone </th>';
                	echo'<th class="thtable textcen">Adresse </th>';
                  echo'<th class="thtable textcen">Zone </th>';
                	echo'<th colspan="2" class="thtable">Action</th>';
            	echo'</tr>';
            	$i=1;
            	while($ligne=pg_fetch_assoc($client))
            	{
            	echo'<tr class="ld'.($i%2).'">';
                  echo'<td class="textcen">'.$i.'</td>';
                	echo'<td class="textgau">'.$ligne['nom_cli'].'</td>';
                	echo'<td class="textcen">'.$ligne['tel'].'</td>';
                	echo'<td class="textcen">'.$ligne['adresse_cli'].'</td>';
                  echo'<td class="textcen">'.$ligne['zone_liv'].'</td>';
                	echo'<td class="textcen"><a href="Fmodifier.php?id_cli='.$ligne['id_cli'].
                			'&nom_cli='.$ligne['nom_cli'].
                			'&tel='.$ligne['tel'].
                			'&adresse_cli='.$ligne['adresse_cli'].
                      '&zone_liv='.$ligne['zone_liv'].
                			'"><img src="/Images/modifier.png" width="25px"height="25px" class="img" title="Modifier"></a></td>';
                	echo'<td class="textcen"><a href="Fsupprimer.php?id_cli='.$ligne['id_cli'].
                      '&nom_cli='.$ligne['nom_cli'].
                      '&tel='.$ligne['tel'].
                      '&adresse_cli='.$ligne['adresse_cli'].
                      '&zone_liv='.$ligne['zone_liv'].
                			'"><img src="/Images/supprimer.png" width="25px"height="25px" class="img" title="Supprimer"></a></td>';
            	echo'</tr>';
            	$i++;
            	}
	      echo'</table>';
	echo'</div>';
	include'../../Layout/footer.php';

		/* -------Fin  liste.php------------- */
?>
