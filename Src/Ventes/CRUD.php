<?php
//-----COURS ACHAT
if($_POST['mas']=='VA')
	 {
	$date_ve=$_POST['date_ve'];
	$libele=$_POST['libele'];
	$id_cli=$_POST['id_cli'];
	$requete="insert into ventes (date_ve,libele,id_cli)";
	$requete.=" values ('$date_ve','$libele',$id_cli)";
		if($_POST['valider']=='Valider')
	$vajouter=pg_query($dbconn,$requete);
	}
elseif($_POST['mas']=='VM')
	 {
	$id_ve=$_POST['id_ve'];
	$date_ve=$_POST['date_ve'];
	$libele=$_POST['libele'];
	$id_cli=$_POST['id_cli'];
	$requete="update ventes set date_ve='$date_ve',libele='$libele',id_cli=$id_cli ";
	$requete.=" where id_ve=$id_ve";
			if($_POST['valider']=='Valider')
	$vmodifier=pg_query($dbconn,$requete);
	  }
elseif($_POST['mas']=='VS')
	 {
	$id_ve=$_POST['id_ve'];
	$valider=$_POST['valider'];
	if($valider=='Oui') {
	$requete="delete from ventes where id_ve=$id_ve";
	$vsupprimer=pg_query($dbconn,$requete);
	 }
	 }

/*
	 	  	 //-----VALIDATION--------------

elseif($_POST['mas']=='V')
	 {
	$id_ac=$_POST['id_ac'];
	$etat=$_POST['etat'];
	$valider=$_POST['valider'];
	if($valider=='Oui') {
	$requete="update  achats set etat=1 where id_ac=$id_ac";
	$avalider=pg_query($dbconn,$requete);
	 }
	 }
elseif($etat=='1') {
	 $requete12="update contenu_acha,matieres set qte_ma=qte_vir where id_ma=$id_ma" ;
	 $echange=pg_query($dbconn,$requete12);
 } */
 	 //-----CONTENU VENTE-----------

 	 if($_POST['mas']=='CVA')
	 {
	$id_ve=$_POST['id_ve'];
	$id_cve=$_POST['id_cve'];
	$id_pro=$_POST['id_pro'];
	$libele=$_POST['libele'];
	$qte_v=$_POST['qte_v'];
	/*$rprix="select prix from produits where id_pro=$id_pro";
	$eprix=pg_query($dbconn,$rprix);
	$ligne=pg_fetch_assoc($eprix);
	$prix=$ligne['prix'];*/
	$requete100="insert into contenu_ve (id_cve,id_pro,nom_pro,qte_v,prix) values ($id_cve,$id_pro,$nom_pro,$qte_v,$id_ve,$prix)";
	$cvajouter=pg_query($dbconn,$requete100);
	}
/*
		if($_POST['valider']=='Valider')
		{
			$cvajouter=pg_query($dbconn,$requete);
	$requete="update ventes set montant= t.smontant from (select sum(prix*qte_ve) as smontant from
				contenu_ve where id_ve=$id_ve) as t where id_ve=$id_ve";
				$vcajouter=pg_query($dbconn,$requete);
	$requete="update produits set qte_vir=qte_vir+$qte_ma where id_ma=$id_ma";
	 	   $resultat=pg_query($dbconn,$requete);

		}

	 }

elseif($_POST['mas']=='CM')
	 {
	$id_ac=$_POST['id_ac'];
	$id_cac=$_POST['id_cac'];
	$qte_ma=$_POST['qte_ma'];
	$id_ma=$_POST['id_ma'];
	$qte_ma_orig=$_POST['qte_ma_orig'];
	$requete="update contenu_acha set qte_ma=$qte_ma";
	$requete.=" where id_cac=$id_cac";
			if($_POST['valider']=='Valider'){
					$cmodifier=pg_query($dbconn,$requete);
					$requete="update matieres set qte_vir=qte_vir+$qte_ma-$qte_ma_orig where id_ma=$id_ma";
					$resultat=pg_query($dbconn,$requete);

	 		}
	 }

	 elseif($_POST['mas']=='CS')
	 {
	$id_ac=$_POST['id_ac'];
	$id_cac=$_POST['id_cac'];
   $qte_ma=$_POST['qte_ma'];
	$id_ma=$_POST['id_ma'];
	$valider=$_POST['valider'];
	if($valider=='Oui') {
				$requete="delete from contenu_acha where id_cac=$id_cac";
				$asupprimer=pg_query($dbconn,$requete);
				$requete="update matieres set qte_vir=qte_vir-$qte_ma where id_ma=$id_ma";
			   $resultat=pg_query($dbconn,$requete);

	 }
	 }

 	  	 //----------LIVRAISON-----------

 	if($_POST['mas']=='LVA')
	 {
	$id_ac=$_POST['id_ac'];
	$date_liv=$_POST['date_liv'];
	$libele=$_POST['libele'];
	$requete="insert into livraisons (id_ac,date_liv,libele) values ($id_ac,'$date_liv','$libele') returning id_liv" ;
			if($_POST['valider']=='Valider'){
				$lajouter=pg_query($dbconn,$requete);
				$ligne=pg_fetch_assoc($lajouter);
				$id_liv=$ligne['id_liv'];
				$requetel="select id_cac from contenu_acha where id_ac=$id_ac and qte_ma>qte_liv";
				$lcontenu=pg_query($dbconn,$requetel);
				while($lignel=pg_fetch_assoc($lcontenu)) {
					$id_cac=$lignel['id_cac'];
					$requeteli="insert into contenu_liv (id_liv,id_cac) values ($id_liv,$id_cac)";
					$rcontenu=pg_query($dbconn,$requeteli);

			}

	 }
}

elseif($_POST['mas']=='LVM')
	 {
	$id_ac=$_POST['id_ac'];
	$id_liv=$_POST['id_liv'];
	$date_liv=$_POST['date_liv'];
	$libele=$_POST['libele'];
	$requetec=" update livraisons set date_liv=$date_liv,libele=$libele";
	$requetec.=" where id_ac=$id_ac ";
		if($_POST['valider']=='Valider')
	$lvmodifier=pg_query($dbconn,$requetec);
	}

elseif($_POST['mas']=='LVS')
	 {
	$id_ac=$_POST['id_ac'];
	$id_liv=$_POST['id_liv'];
	$valider=$_POST['valider'];
		if($valider=='Oui') {
	$requete="delete from livraisons where id_liv=$id_liv";
	$asupprimer=pg_query($dbconn,$requete);
	 }
	 }
		//-------CONTENU LIVRAISON--------

elseif($_POST['mas']=='LM')
	 {
	$id_ac=$_POST['id_ac'];
	$id_liv=$_POST['id_liv'];
	$id_ma=$_POST['id_ma'];
	$id_cliv=$_POST['id_cliv'];
	$id_cac=$_POST['id_cac'];
	$qte_l=$_POST['qte_l'];
	$qte_liv=$_POST['qte_liv'];
	$qte_l_orig=$_POST['qte_l_orig'];
	$requetek="update contenu_liv set qte_l=$qte_l";
	$requetek.=" where id_cliv=$id_cliv ";
			if($_POST['valider']=='Valider'){

	if(pg_query($dbconn,"update contenu_acha set qte_liv=qte_liv+($qte_l-$qte_l_orig) where id_cac=$id_cac"))
	$lmodifier=pg_query($dbconn,$requetek);

	$requete="update matieres set qte_reel=qte_reel+$qte_l-$qte_l_orig where id_ma=$id_ma";
   $resultat=pg_query($dbconn,$requete);

	$eliv=pg_query($dbconn,"select count(*) as nb from contenu_acha where id_ac=$id_ac and qte_liv<>0");
	$leliv=pg_fetch_assoc($eliv);
	if($leliv['nb']!=0) $r=pg_query($dbconn,"update achats set etat_liv='P' where id_ac=$id_ac");

	$eliv=pg_query($dbconn,"select count(*) as nb from contenu_acha where id_ac=$id_ac and qte_liv<qte_ma");
	$leliv=pg_fetch_assoc($eliv);
	if($leliv['nb']==0) $r=pg_query($dbconn,"update achats set etat_liv='T' where id_ac=$id_ac");

 	}
 	}

 	 elseif($_POST['mas']=='LS')
	 {
	$id_ac=$_POST['id_ac'];
	$id_liv=$_POST['id_liv'];
	$id_cliv=$_POST['id_cliv'];
	$valider=$_POST['valider'];
	if($valider=='Oui') {
	$requete="delete from contenu_liv where id_cliv=$id_cliv";
	$lsupprimer=pg_query($dbconn,$requete);
	 }
	 }


 	 //-----PAYEMENT----------------

 	  if($_POST['mas']=='PA')
	 {
	$id_ac=$_POST['id_ac'];
	$date_pay=$_POST['date_pay'];
	$montant=$_POST['montant'];
	$libele=$_POST['libele'];
	$requete="insert into payements (id_ac,montant,libele) values ($id_ac,$montant,'$libele')";
		if($_POST['valider']=='Valider'){
			if(pg_query($dbconn,"update achats set montant_paye=montant_paye+$montant where id_ac=$id_ac")) {
			$pajouter=pg_query($dbconn,$requete);
			}
		}

	 }

elseif($_POST['mas']=='PM')
	 {
	$id_ac=$_POST['id_ac'];
	$id_pay=$_POST['id_pay'];
	$date_pay=$_POST['date_pay'];
	$libele=$_POST['libele'];
	$montant=$_POST['montant'];
	$montant_orig=$_POST['montant_orig'];
	//$libele=$_POST['libele'];
	$requete="update payements set montant=$montant,date_pay='$date_pay',libele='$libele' where id_pay=$id_pay ";
			if($_POST['valider']=='Valider')
			if(pg_query($dbconn,"update achats set montant_paye=montant_paye+$montant-$montant_orig where id_ac=$id_ac"))
	$pmodifier=pg_query($dbconn,$requete);

	 }
elseif($_POST['mas']=='PS')
	 {
	$id_pay=$_POST['id_pay'];
	$valider=$_POST['valider'];
	if($valider=='Oui') {
	$requete="delete from payements where id_pay=$id_pay";
	$lsupprimer=pg_query($dbconn,$requete);
	 }
	 }

	 $requete="select id_ac,date_ac,libele,etat_liv,etat from achats natural join fournisseurs order by id_ac desc limit 50";
	 $listeac=pg_query($dbconn,$requete);

	 $requete2="select id_ac,id_fo,date_ac,libele,nom_fo,montant,montant_paye,etat_liv,etat from
	 achats natural join fournisseurs where id_ac=$id_ac";
	 $achat=pg_query($dbconn,$requete2);

 	 $requete4="select id_ac,id_cac,id_ma,nom_ma,prix,qte_ma,qte_liv from
	  contenu_acha natural join matieres natural join achats where id_ac=$id_ac";
	 $contenuac=pg_query($dbconn,$requete4);

	 $requete5="select * from contenu_acha natural join matieres";
	 $jointure=pg_query($dbconn,$requete5);

	 $requete6="select id_ma,prix_ma,nom_ma from *matieres" ;
	 $ajouter=pg_query($dbconn,$requete6);

  $requete8="select id_ac,id_pay,date_pay,libele,montant from payements where id_ac=$id_ac";
	 $payement=pg_query($dbconn,$requete8);

	 $requete9="select id_ac,id_liv,date_liv,libele from livraisons where id_ac=$id_ac";
	 $listeliv=pg_query($dbconn,$requete9);

	 $requete10="select id_ma,id_ac,id_cac,id_cliv,nom_ma,qte_ma,cl.qte_l,qte_liv,id_liv
	  from contenu_liv cl join contenu_acha using  (id_cac) join matieres using(id_ma)  where id_liv=$id_liv order by nom_ma";
	 $livraison=pg_query($dbconn,$requete10);

	 $requete11="select id_ac,libele,date_ac from achats where id_ac=$id_ac" ;
	 $pachat=pg_query($dbconn,$requete11);
*/
//----COURS ACHAT-------------------//

	 $requete="select id_ve,date_ve,libele,etat from ventes order by id_ve";
      $listeve=pg_query($dbconn,$requete);
   $requete2="select id_ve,id_cli,date_ve,libele,nom_cli,montant,montant_paye,montant_res,etat from
	             ventes natural join clients where id_ve=$id_ve";
	    $vente=pg_query($dbconn,$requete2);
   $requete3="select id_cli,nom_cli,adresse_cli from clients";
      $lclient=pg_query($dbconn,$requete3);

	 $requete4="select id_cve,id_ve,id_pro,nom_pro,prix,qte_v,qte_liv from
 							contenu_ve natural join produits  where id_ve=$id_ve";
			$contenuve=pg_query($dbconn,$requete4);

   $requete5="select id_liv,id_ve,date_liv,libele from liv_vente";
			$lvente=pg_query($dbconn,$requete5);

   $requete6="select id_pro,id_ve,id_cve,id_cliv,nom_pro,qte_pro,qte_liv,id_liv
			 from contenu_liv_vente  join contenu_liv_vente using  (id_cve) join produits using(id_pro)  where id_liv=$id_liv order by nom_pro";
			$livraison=pg_query($dbconn,$requete6);

	 $requete7="select id_ve,id_pve,date_pve,libele,montant_pve from payvente where id_ve=$id_ve";
	 	  $payement=pg_query($dbconn,$requete7);
	 $requete8="select id_cli,nom_cli,tel,adresse_cli zone_liv from clients";
		  $client=pg_query($dbconn,$requete8);
	 $requete9="select id_pro,prix,nom_pro from produits" ;
	 	  $lproduit=pg_query($dbconn,$requete9);

?>
