<?php
try{
	$mydb = new PDO('mysql:host=localost; dbname=becode;charset=utf8','root', '');
} catch(Exception $e){
	die('Erreur: '.$e->getMessage());
}

$resultat = $mydb->query('SELECT * FROM meteo');

$donnees = $resultat->fetch();

while($donnees = $rsultat->fetch()){
	echo $donees['nom_de_la_colonne'];
}

$resultat->closeCursor();
