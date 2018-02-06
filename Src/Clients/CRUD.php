<?php
if($_POST['mas']=='LA')
	 {
	$id_cli=$_POST['id_cli'];
	$nom_cli=$_POST['nom_cli'];
	$tel=$_POST['tel'];
	$adresse_cli=$_POST['adresse_cli'];
  $zone_liv=$_POST['zone_liv'];
	$requete="insert into clients (nom_cli,tel,adresse_cli,zone_liv)";
	$requete.=" values ('$nom_cli','$tel','$adresse_cli','$zone_liv')";
			if($_POST['valider']=='Valider')
	$resultat=pg_query($dbconn,$requete);
	 }
	             /*  Lmodifier */
elseif($_POST['mas']=='LM')
	 {
  $id_cli=$_POST['id_cli'];
  $nom_cli=$_POST['nom_cli'];
  $tel=$_POST['tel'];
	$adresse_cli=$_POST['adresse_cli'];
  $zone_liv=$_POST['zone_liv'];
	$requete="update clients set nom_cli='$nom_cli',tel='$tel',adresse_cli='$adresse_cli',zone_liv='$zone_liv'";
	$requete.="  where id_cli='$id_cli'";
			if($_POST['valider']=='Valider')
	$resultat=pg_query($dbconn,$requete);
	 }
	 				  /*   Lsupprimer */
elseif($_POST['mas']=='LS')	{
  $id_cli=$_POST['id_cli'];
	$valider=$_POST['valider'];
 if($valider=='Oui') {
	$requete="delete from clients where id_cli='$id_cli'";
	$resultat=pg_query($dbconn,$requete);
	 		}
	 	 }
		$requete12="select * from clients ";
		$client=pg_query($dbconn,$requete12);
?>
