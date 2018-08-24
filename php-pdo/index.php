<?php 


	// Connection base de donnée
	try {
		// On se connecte à MySQL
		$bd = new PDO('mysql:host=localhost;dbname=weather-app;charset=utf8', 'phpmyadmin', '12345678');
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
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Météo</title>

		<!-- CSS -->
		<link rel="stylesheet" href="">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div>
			
		</div>
		<div>
			<form action="#" method="POST" role="form">
				<legend>Météo</legend>
					<table>
						<!-- Afficher les donner avec le fetch -->
						<?php
						 while ($donnees = $resultat->fetch()) { ?>
							<tr>
								<!-- mettre un value pour que la suppression se fasse correctement car il ne le reconnait que par sa value et que pour le checkbox sa valeur par defaut est on. -->
								<td><input type="checkbox" name="<?php echo $donnees['ville']; ?>" value='<?php echo $donnees['ville']; ?>'/>&nbsp;</td>
								<td><?php echo $donnees['ville']; ?></td>
								<td><?php echo $donnees['haut']; ?></td>
								<td><?php echo $donnees['bas']; ?></td>
							</tr>
						<?php 
					}
						$resultat->closeCursor(); ?>
					</table>
				<div class="form-group">
					<label for="maville">ville</label>
					<input type="text" name="ville" class="form-control" id="maville" placeholder="ville">
				</div>
				<div class="form-group">
					<label for="mamin">min</label>
					<input type="number" name="min" class="form-control" id="mamin" placeholder="0">
				</div>
				<div class="form-group">
					<label for="mamax">max</label>
					<input type="number" name="max" class="form-control" id="mamax" placeholder="0">
				</div>
			
				<button type="submit" name='submit' class="btn btn-primary">Submit</button>
			</form>
		</div>
		<!-- JavaScript & jQuery -->
		<script src=""></script>
		<script src=""></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	</body>
</html>