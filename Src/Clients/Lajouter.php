<?php

	include'liste.php';
		/*--------Debut Lajouter.php---*/
	echo '<div id="content">';
	echo '<div id="cform"><div id="cform2">
			  <div id="cheader" class="textcen"><h2 class="titrecform">Ajouter nouveau  client</h2></div><br/><br/><br/>';
		echo'	<form action="liste.php" method="post">';
		echo'<input type="hidden" name="mas" value="LA"/>';
				  echo '<table cellpadding="3" class="w95" >';
							echo'	<tr><td class="textinput">Nom</td>
									<td><input type="text" name="nom_cli" class="labinput"></td></tr>';
							echo'	<tr><td class="textinput">Téléphone</td>
									<td><input type="text"  name="tel" class="labinput"></td></tr>';
							echo'	<tr><td class="textinput">Adresse</td><td>
									<input type="text" name="adresse_cli" class="labinput"></td></tr>';
							echo'	<tr><td class="textinput">Zone de livraison </td><td>
									<input type="text" name="zone_liv" class="labinput"></td></tr>';
				  echo '</table>';
					echo '<div id="cfooter" class="textdro  butcform">';

					echo'<input type="submit" name="valider" value="Valider"  class="bvalid">&nbsp;&nbsp;
					     <input type="submit" name="valider" value="Annuler"  class="bannul"></div></div></div>';
	echo '</form>';
	echo '</div>';
	include'../../Layout/footer.php';

		/*----------Fin Fajouter.php------------*/
?>
