<?php 


	// Connection base de donnée
	try {
		// On se connecte à MySQL
		$bd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'phpmyadmin', '12345678');
	} catch(Exception $e) {
		// En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}	

	$submit = isset($_POST['submit']);
	if ($submit == true){
		// récup. form
		$ville = $_POST['ville'];
		$max = $_POST['max'];
		$min = $_POST['min'];
		$bd -> exec('INSERT INTO meteo(ville, haut, bas) VALUES("'.$ville.'", "'.$max.'", "'.$min.'")');

		// il transfert les valeurs du tableau post au tableau checkbox
		$checkbox = $_POST;
		// parcours tout le tableau checkbox
		foreach ($checkbox as $val) {
			//test pour différencier les differents checkbox au autres valeurs
			if ($val != $ville AND $val != $max AND $val != $min AND $val != $checkbox['submit']) {
				$bd -> exec('DELETE from meteo WHERE ville = "'.$val.'" ');
			}

		}
	}

	//var_dump($_POST);


	$resultat = $bd->query('SELECT * FROM meteo');

?>