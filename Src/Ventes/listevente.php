<?php

 	include'../../Layout/header.php';

 	  echo '<div id="logosahel">';
		 	echo'<img src="../../Images/sahel.png" width="100%" height="100%" alt="">';
	  echo '</div>';
		echo '<div id="logoyogo">';
		 	 echo'<img src="../../Images/ventes.png" width="100%" height="100%" alt="">';
		echo '</div>';
	   include'../../Layout/header2.php';
     echo'<div id="menu2">';

     echo '</div>';
	    include 'CRUD.php';

	     echo'<div id="menu2">';
       echo'<br>';
       echo ' <a href="/Src/Ventes/client.php"> <button class="butmenu2">Clients</button> </a>';
       echo ' <a href="/Src/Ventes/stock.php"> <button class="butmenu2">Stocks</button> </a>';

       echo'<br>';
       echo'<br>';

		 	       echo'<a href="Vajouter.php">
          	<img src="/Images/ajouter.png" width="25px"height="25px"
          	class="img" title="Ajouter"></a></th>';
          	echo '<h4 class="titreh4"> Liste des ventes </h4><br/>';
          	while($ligne=pg_fetch_assoc($listeve))
          	{
          	echo '<a href="vente.php?id_ve='.$ligne['id_ve'].'"><button class="butmenu2" title="'.$ligne['date_ve'].'
          	'.$ligne['libele'].'"><b class="t18"x>'.$ligne['date_ve'].' '.$ligne['libele'].'</b></button></a>';
          	}
	     echo '</div>';
	include'../../Layout/footer.php';

?>
