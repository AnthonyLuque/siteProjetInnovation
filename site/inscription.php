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
		
		

		<!-- Page d'inscription -->
		<div class="body">
		
			<?php 
			if(!isset($_POST['submitInscription'])){
			?>
				<form method="post" action="inscription.php" align="center">
					<input type="text" name="nomPatient" placeholder = "Nom du patient" style="width : 400px;"/> <br />
					<input type="text" name="prenomPatient" placeholder = "Prénom du patient" style="width : 400px;"/> <br />
					<input type="text" name="mailPatient" placeholder = "Mail du patient" style="width : 400px;"/> <br />
					<input type="password" name="motDePasse" placeholder = "Mot de passe" style="width : 400px;"> <br />
				
					<input type="submit" name = "submitInscription" value="Inscrire le patient" style="width : 200px">
				</form>	
			<?php
			} else {
			?>
				<form method="post" action="inscription.php" align="center">
					<input type="text" name="nomPatient" placeholder = "Nom du patient" value = "<?php echo $_POST['nomPatient'];?>" style="width : 400px;"/> <br />
					<input type="text" name="prenomPatient" placeholder = "Prénom du patient" value = "<?php echo $_POST['prenomPatient'];?>" style="width : 400px;"/> <br />
					<input type="text" name="mailPatient" placeholder = "Mail du patient" value = "<?php echo $_POST['mailPatient'];?>" style="width : 400px;"/> <br />
					<input type="password" name="motDePasse" placeholder = "Mot de passe" style="width : 400px;"> <br />
				
					<input type="submit" name = "submitInscription" value="Inscrire le patient" style="width : 200px">
				</form>	
			<?php		
			}
			?>
			
			<?php 
			if(!empty($_POST['nomPatient']) and !empty($_POST['prenomPatient']) and !empty($_POST['mailPatient']) and !empty($_POST['motDePasse'])){
				$inscrire = $bdd-> prepare('INSERT INTO utilisateur (nomUtilisateur, prenomUtilisateur, mailUtilisateur, motDePasse, idMedecinReferent) VALUES (:nomUtilisateur, :prenomUtilisateur, :mailUtilisateur, :motDePasse, :idMedecinReferent)');
				$inscrire ->bindValue('nomUtilisateur', $_POST['nomPatient'], PDO::PARAM_STR);
				$inscrire ->bindValue('prenomUtilisateur', $_POST['prenomPatient'], PDO::PARAM_STR); 
				$inscrire ->bindValue('mailUtilisateur', $_POST['mailPatient'], PDO::PARAM_STR); 
				$inscrire ->bindValue('motDePasse', $_POST['motDePasse'], PDO::PARAM_STR);
				$inscrire ->bindValue('idMedecinReferent', $_SESSION['idUtilisateur'], PDO::PARAM_STR);
				$inscrire->execute();
				
				$inscrire->closeCursor();
				header("Location: accueil.php");
			}
			?>
			
		</div>		
		
		

		<!-- Footer -->
		 <?php include("sections/footer.php"); ?>
		 
    </body>
	
	
</html>