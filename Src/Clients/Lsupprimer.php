<?php

	$id_cli=$_GET['id_cli'];
	$nom_cli=$_GET['nom_cli'];
	$tel=$_GET['tel'];
	$adresse_cli=$_GET['adresse_cli'];
  $zone_liv=$_GET['zone_liv']
	include'liste.php';
	
		/* ---------Debut Fsupprimer.php-------- */
	echo '<div id="content">';
    	echo'<form action="liste.php" method="post">';
        	echo'<input type="hidden" name="mas" value="S"/>';
        	echo'<input type="hidden" name="id_cli" value="'.$id_cli.'">';
    	    echo'<div id="sform"><div id="sform2"><div id="sheader" class="titrecform">Suppression</div><br/><br/><br/><br/><br/>
    		      <p class="textcen" >Voulez vous supprimer le client
    		        <b class="crouge">'.$nom_cli.' '.$adresse_cli.'?</b></p>
    	           <div id="sfooter">';
    		 	echo'<input type="submit" name="valider" value="Oui" class="bvalid">
    		 		   <input type="submit" name="valider" value="Non" class="bannul"></div></div></div>';
    	echo'</form>';
	echo'</div>';

			/* -------Fin Fsupprimer.php------------- */

?>
