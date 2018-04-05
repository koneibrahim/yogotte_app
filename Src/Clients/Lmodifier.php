<?php
	$id_cli=$_GET['id_cli'];
	$nom_cli=$_GET['nom_cli'];
	$tel=$_GET['tel'];
	$adresse_cli=$_GET['adresse_cli'];
  $zone_liv=$_GET['zone_liv']
  	include'liste.php';
		/*--------Debut Fmodifier.php---*/
		echo '<div id="content">';
		echo '<div id="cform"><div id="cform2">
				  <div id="cheader" class="textcen"><h2 class="titrecform"> Modification client</h2></div><br/><br/><br/>';
			echo'	<form action="liste.php" method="post">';
		        	echo'<input type="hidden" name="mas" value="LM"/>';
		        	echo'<input type="hidden" name="id_cli" value="'.$id_cli.'">';
        		  echo'<table cellpadding="5" class="w95">';
							   	echo'<tr><td class="textinput">Nom client</td><td>
				        		  <input type="text" name="nom_cli" value="'.$nom_cli.'" class="labinput"></td></tr>';
				        	echo'<tr><td class="textinput">Téléphone</td><td>
				        		  <input type="text" name="tel" value="'.$tel.'" class="labinput"></td></tr>';
				        	echo'<tr><td class="textinput">Adresse</td><td>
				        		  <input type="text" name="adresse_cli" value="'.$adresse_cli.'" class="labinput"></td></tr>';
				          echo'<tr><td class="textinput">Zone livraison </td><td>
				          		<input type="text" name="zone_liv" value="'.$zone_liv.'" class="labinput"></td></tr>';
        	  echo'</table>';
        	echo'<div id="mfooter">';
    		echo'<input type="submit" name="valider" value="Valider"  class="bvalid">&nbsp;&nbsp;
    			   <input type="submit" name="valider" value="Annuler"  class="bannul"></div></div></div>';*/
    	echo'</form>';
	echo'</div>';
	include'../../Layout/footer.php';
?>
