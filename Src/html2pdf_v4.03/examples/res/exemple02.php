<?php

  
	echo '<style type="text/css">;
			<!--
			table.morpion
			{
				border:        dashed 1px #444444;
			}

			table.morpion td
			{
				font-size:    15pt;
				font-weight:  bold;
				border:       solid 1px #000000;
				padding:      1px;
				text-align:   center;
				width:        25px;
			}

			table.morpion td.j1 { color: #0A0; }
			table.morpion td.j2 { color: #A00; }

			-->
		</style>';
		
	
$lpressing=pg_connect("dbname=db_laaf user=moussa password=30052017 host=localhost port=5432");
  $id_fa=$_GET['id_fa'];
  
	$requete2="select  id_fa,id_cl,id_re,nom_re||'  '||prenom_re as recep,nom_cl,prenom_cl,date_depot,duree,date_retrait,etat_li,etat_fa,
telephone,adresse,mont_total, mont_paye from factures  natural  join clients natural
 join receptionnistes where id_fa=$id_fa group by id_fa,id_cl,id_re,recep,nom_cl,prenom_cl,date_depot,duree,date_retrait,
 etat_li,telephone,adresse,mont_paye,mont_total,etat_fa";
$pfacture=pg_query($lpressing,$requete2);
$requete3="select id_fa,id_dfa,id_pr,id_ar,id_la,id_pr,quantite,prix_uni,designation,type_la,type,total_li,observation from detail_facture natural join
 prix natural join articles natural join lavages natural join factures where id_fa=$id_fa  ";
$dfacture=pg_query($lpressing,$requete3);
	//echo 	'<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt">';
$facture=pg_fetch_assoc($pfacture);
echo'	<table >';
echo '</tr>';
echo '<td>';
echo'	<table >';
echo '<tr class="">';
echo '<td  colspan="" ><h5 class="cen"><b  class="Fimp1"> LAAF-Pressing</b></br><b class="Fimp2">Sise à Quinzembougou sur la route de Sotiba BAMAKO 
Rue: Titi Niare dans l\'immeuble de Dossolo Traore</b><br/>
<b class="Fimp3">Tel :(+233) 76 14 71 00 Site :www.laafpressing.com</b></h5></td>';
echo '</tr>';
echo '<tr class="">';
	echo '<td colspan="">Facture N°:<b class="rouge"> '.$id_fa.'</b></td>';
echo '</tr>';
echo '<tr class="">';
	echo '	<td colspan="2" class="dro" >Date de depôt <b  class="Fimp4">: '.$facture['date_depot'].'</b></td>';
	//echo '<td class="gau ff"></td>';	
echo '</tr>';
echo '<tr class="">';
	echo '<td class="">Adresse <b  class="Fimp4">: '. ucfirst($facture['adresse']).'</b>
	</td><td class="dro" colspan="">Téléphone <b  class="Fimp4">: '.$facture['telephone'].'</b></td>';
echo '</tr>';
echo '<tr class="">';
	echo '<td colspan="6">Client(e) <b  class="Fimp4">: '. ucwords($facture['nom_cl'].' '.$facture['prenom_cl']).'</b></td>';
echo '</tr>';
echo'</table>';
echo'	<table>';

echo '<tr class="Flin">';
echo	'<th class="">Désignation</th>';
//echo	'<th class="">Type</th>';
echo	'<th class="">Type de lavage</th>';
echo	'<th class="">Prix unitaire</th>';
echo	'<th class="">Quantite</th>';
echo	'<th class="">Total livraison</th>';
echo	'<th class="	">Observation</th>';
echo'</tr>';
$i=1;
while($ligne=pg_fetch_assoc($dfacture)){
echo'<tr class="lin' .($i%2!=0).'">';
  
		echo'<td class="Fligne cen">'.$ligne['designation'].'</td>';
	//echo'<td class="ligne cen">'.$ligne['type'].'</td>';
		echo'<td class="Fligne cen">'.$ligne['type_la'].'</td>';
	echo'<td class="Fligne cen">'.number_format($ligne['prix_uni'],0,' ',' ').'<sup>FCFA</sup></td>';
		echo'<td class="Fligne cen">'.$ligne['quantite'].'</td>';
		echo'<td class="Fligne cen">'.$ligne['total_li'].'</td>';
	echo'<td class="Fligne cen">'.$ligne['observation'].'</td>';
	
echo'</tr>';
$i++;
	}
	echo '<tr class="">';
	echo '<td class="ll" colspan="6">Montant Total <b  class="Fimp4">: '.number_format($facture['mont_total'],0,' ',' ').'<sup>F</sup></b></td>';
echo '</tr>';
echo '<tr class="lin">';
	echo '<td class="ll" colspan="6">Montant Payé <b  class="Fimp4">: '.number_format($facture['mont_paye'],0,' ',' ').'<sup>F</sup></b></td>';
echo '</tr>';
$reste = $facture['mont_total'] - $facture['mont_paye'];
	echo '<td class="ll" colspan="6">Reste à payer <b  class="Fimp4">: '.number_format($reste,0,' ',' ').'<sup>F</sup></b></td>';
echo '</tr>';

echo'</table>';
echo'	<table >';
echo '<tr >';
	echo '<td class="cen ">Date de retrait <b  class="Fimp4">: '.$facture['date_retrait'].'</b></td>';
	
echo '</tr>';
echo '<tr class="">';
	echo '<td class="dro">Réceptionniste <b  class="Fimp4">: '. ucwords($facture['recep']).'</b></td>';
echo '</tr>';
echo'</table>';
echo '</td>';
echo '</tr>';
echo'</table>';
//echo'</div>';
	//echo 	'</page>';
?>
