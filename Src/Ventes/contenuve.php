<?php

  $id_ve=$_GET['id_ve'];
  $id_cve=$_GET['id_cve'];
  $date_ve=$_GET['date_ve'];
  $libele=$_GET['libele'];
  $etat=$_GET['etat'];

  include'vente.php';
			/*-------Debut Contenuac-----------*/
  echo'<div id="contvert2">';
  echo'<h3 class="titrecform textcen">Contenu de la vente de '.$libele.' '.$date_ve.' </h3><br/>';
    echo'<table cellpadding="3"  border="0" class="w90">';
      	//if ($etat==0) {
      	echo'<tr class="thajouter">';
          	echo'<th colspan="7" class="textdro thtable">
          	<a href="Vajouter.php?id_ve='.$id_ve.'">
          	<img src="/Images/ajouter.png" width="25px"height="25px" title="Ajouter"></a></th>';
      	echo '</tr>';
      	//}
      	echo'<tr>';
          	echo'<th class="thtable textcen">N°</th>';
          	echo'<th class="thtable textcen">Nom produit</th>';
          	echo'<th class="thtable textcen">Prix </th>';
          	echo'<th class="thtable textcen">Quantité</th>';
          	echo'<th class="thtable textcen">Quantité livré</th>';
          	//	if ($etat==0) {
          	echo'<th class="thtable textcen" colspan="2">Action</th>';
        //  }
      	echo'</tr>';
      	$i=1;
            	while($ligne=pg_fetch_assoc($contenuve))
            	{
       	echo'<tr class="ld'.($i%2).'">';
            	echo'<td class="textcen">'.$i.'</td>';
            	echo'<td class="textgau">'.$ligne['nom_pro'].'</td>';
            	echo'<td class="textcen">'.$ligne['qte_v'].'</td>';
            	echo'<td class="textcen">'.$ligne['prix'].'</td>';
              echo'<td class="textcen">'.$ligne['qte_liv'].'</td>';
              // Modification le contenu de la vente
      	//if ($etat==0) {
               echo'<td class="textcen"><a href="Vmodifier.php?id_cve='.$id_cve.
                   '&date_ve='.$ligne['date_ve'].
                   '&libele='.$ligne['libele'].
                   '&etat='.$ligne['etat'].
            			 '"><img src="/Images/modifier.png" width="25px"height="25px" class="img" title="Modifier"></a></td>';
               echo'<td class="textcen"><a href="Vsupprimer.php?id_ve='.$id_ve.
                    '&date_ve='.$ligne['date_ve'].
                    '&libele='.$ligne['libele'].
                    '&etat='.$ligne['etat'].
            			'"><img src="/Images/supprimer.png" width="25px"height="25px" class="img" title="Modifier"></a></td>';
              // }

       echo'</tr>';
      	$i++;
      	      }
    echo'</table>';
  echo'</div>';
      	include'../../Layout/footer.php';
?>
