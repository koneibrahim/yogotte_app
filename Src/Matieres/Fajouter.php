
<?php


	include'liste.php';

	
	/*-----Debut Fajouter.php------------*/
	
	echo '<div id="content">';
	
	echo '<div id="cform"><div id="cform2">
	 <div id="cheader"><h2 class="titrecform">Ajout Nouvelle matière</h2></div><br/><br/><br/>';
	echo'	<form action="liste.php" method="POST">';
	echo'<input type="hidden" name="mas" value="A"/>';
	echo '<table cellpadding="3" class="w95">';
	
	echo'	<tr><td class="textinput">Nom</td><td><input type="text" name="nom_ma" class="labinput"></td></tr>';
	
	echo '<tr><td class="textinput">Unité</td><td><select name="unite" class="labinput">';
	echo '<option value="kg">Kilogramme</option>';
	echo '<option value="g">Gramme</option>';
	echo '<option value="ml">Milliitre</option>';
	echo '<option value="p">Pièce</option>';
	echo '<option value="pq">Paquet</option>';
	echo'</select></td></tr>';
			
	echo'	<tr><td class="textinput">Prix matière</td><td><input type="text" name="prix_ma" class="labinput"></td></tr>';
	echo '</table>';
	
	echo '<div id="cfooter" class="textdro">';	
	if($_SESSION['utilisateur']=='Identifie') {
	echo'<input type="submit" name="valider" value="Valider"  class="bvalid">&nbsp;&nbsp;
		  <input type="submit" name="valider" value="Annuler"  class="bannul"></div></div></div>';			
	}
  	echo '</form>';
	echo '</div>';
	include'../../Layout/footer.php';
	
		/*-----Fin Fajouter.php------------*/
	
?>


