<?php

	
	include'liste.php';

	
		/*--------Debut Fajouter.php---*/

	echo '<div id="content">';
	echo '<div id="cform"><div id="cform2">
		  <div id="cheader" class="textcen"><h2 class="titrecform">Ajout nouveau fournisseur</h2></div><br/><br/><br/>';
	echo'	<form action="liste.php" method="post">';
	echo'<input type="hidden" name="mas" value="A"/>';
	echo '<table cellpadding="3" class="w95" >';
	
	echo'	<tr><td class="textinput">Nom</td><td>	<input type="text" name="nom_fo" class="labinput"></td></tr>';
	echo'	<tr><td class="textinput">Téléphone</td><td>	<input type="text"  name="telephone" class="labinput"></td></tr>';
	echo'	<tr><td class="textinput">Addresse</td><td>	<input type="text" name="addresse" class="labinput"></td></tr>';
		
	echo '</table>';
	echo '<div id="cfooter" class="textdro  butcform">';
		if($_SESSION['utilisateur']=='Identifie') {
		
		echo'<input type="submit" name="valider" value="Valider"  class="bvalid">&nbsp;&nbsp;
		<input type="submit" name="valider" value="Annuler"  class="bannul"></div></div></div>';				
   	}
	echo '</form>';
	echo '</div>';
	include'../../Layout/footer.php';
	
		/*----------Fin Fajouter.php------------*/
?>



