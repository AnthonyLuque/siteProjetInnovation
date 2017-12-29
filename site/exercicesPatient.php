<?php include ('functions/logControlMedecin.php'); ?>


<!doctype html>

<html lang="fr">

	<head>
		<title> HandsRehab.com </title>
		<meta charset = "UTF-8">
		<link href="style/main.css" rel="stylesheet" type="text/css" media="screen">
		<link href="style/header.css" rel="stylesheet" type="text/css" media="screen">
		<link href="style/footer.css" rel="stylesheet" type="text/css" media="screen"> 
		<link href="style/menu.css" rel="stylesheet" type="text/css" media="screen"> 
		<link href="style/formulaires.css" rel="stylesheet" type="text/css" media="screen"> 
		<link href="style/requetes.css" rel="stylesheet" type="text/css" media="screen">
	</head>
	
	<?php 
	// connexion à la bdd
	include ('functions/connexionBDD.php'); 
	?>
	
	
	<body>
	
		<!-- Header -->
		<?php include ('sections/header.php'); ?>
		
		

		<!-- Page d'exercices Patient -->
		<div class="body">
		
			<?php 
				// Si un Patient a été selectionné
				if (!empty($_POST['idPatient'])){ 
				
					$req = $bdd-> prepare('SELECT * FROM associationexcercicepatient,exercice WHERE idPatient = :idUtilisateur AND associationexcercicepatient.idExercice = exercice.idExercice');
					$req->bindValue('idUtilisateur', $_POST['idPatient'], PDO::PARAM_STR);
					$req->execute();
					
					while($resultat = $req->fetch(PDO::FETCH_ASSOC)) {
			?> 
						<div class="ligneRequete"> 
							<div class="resultatRequete">
			<?php
								echo $resultat['nomExercice'];
				?> 			</div>
							<div class="boutonsRequeteSupprimer">
								<form method="post" action="exercicesPatient.php">
									<input type="hidden" name="idPatient" value = "<?php echo $_POST['idPatient'];?>" />
									<input type="hidden" name="idExercice" value = "<?php echo $resultat['idExercice'];?>" />
					
									<input type="submit" name = "submitSuppression" value="Supprimer" style="width : 160px">
								</form>
							</div>
						</div> 
			<?php
					}

				// Si on essaie d'accéder à la page sans selectionner de patient
				} else {
					header("Location: suiviClient.php");
				}
			?>
		
		</div>
		

		<!-- Footer -->
		 <?php include("sections/footer.php"); ?>
		 
    </body>
	
	
</html>