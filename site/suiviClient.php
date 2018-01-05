<?php include ('functions/logControlMedecin.php'); ?>


<!doctype html>

<html lang="fr">

	<head>
		<title> HandsRehab.com </title>
		<link rel="icon" type="image/png" href="img/favicon1.png" >
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
		

		
		<!-- Page de suivi client -->
		<div class="body">
		
			<?php 
				// Si l'utilisateur est un Patient
				if ($_SESSION['login'] == "Patient"){ 
				
					

				// Si l'utilisateur est un Medecin
				} else {

					$req = $bdd-> prepare('SELECT * FROM utilisateur WHERE idMedecinReferent = :idMedecinReferent ORDER BY utilisateur.nomUtilisateur, utilisateur.prenomUtilisateur');
					$req->bindValue('idMedecinReferent', $_SESSION['idUtilisateur'], PDO::PARAM_STR);
					$req->execute();
					
					while($resultat = $req->fetch(PDO::FETCH_ASSOC)) {
			?> 
						<div class="ligneRequete"> 
							<div class="resultatRequete">
			<?php
								echo $resultat['nomUtilisateur'] . ' ' . $resultat['prenomUtilisateur']; 
				?> 			</div>
							<div class="boutonsRequete">
								<form method="post" action="exercicesPatient.php">
									<input type="hidden" name="idPatient" value = "<?php echo $resultat['idUtilisateur'];?>" />
					
									<input type="submit" name = "submitExercices" value="Exercices" style="width : 160px">
								</form>
								
								<form method="post" action="statistiquesPatient.php">
									<input type="hidden" name="idPatient" value = "<?php echo $resultat['idUtilisateur'];?>" />
					
									<input type="submit" name = "submitStatistiques" value="Statistiques" style="width : 160px">
								</form>
							</div>
						</div> 
			<?php
					}
				
				}
			?>
		
		</div>		
		
		

		<!-- Footer -->
		 <?php include("sections/footer.php"); ?>
		 
    </body>
	
	
</html>