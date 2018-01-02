
<?php
 session_start();
	echo '<!DOCTYPE html>';
	echo '<html>';
	echo '<head>';
	echo '<meta charset="utf-8" />';
	echo '<title></title>';
	echo '<link href="/Style/style.css" type="text/css" rel="stylesheet">';
	echo '</head>';
	echo '<body>';

	$dbconn=pg_connect("dbname=yogotte user=kone password=okokok host=localhost port=5432");

	echo '<div id="header">';
	echo '<h1 class="titreh1">LAITERIE YOGOTTE RAHMA</h1>';
	echo '<h5 class="titreh5">FADJIGUILA  Tel: 64 30 30 33 / 60 50 59 79
	E-mai:yogotterahma@gmail.com</h5>';
	echo '</div>';
?>
