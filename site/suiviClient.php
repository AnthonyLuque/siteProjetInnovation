<?php include ('functions/logControl.php'); ?>


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
						<div class="resultatRequete"> 
			<?php
							echo $resultat['nomUtilisateur'] . ' ' . $resultat['prenomUtilisateur']; 
			?> 

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