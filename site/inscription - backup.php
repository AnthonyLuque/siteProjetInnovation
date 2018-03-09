<?php 
	session_start();
?>


<!doctype html>

<html lang="fr">

	<head>
		<title> HandsRehab.com </title>
		<meta charset = "UTF-8">
		
		<?php 
			include ('functions/insertLibraries.php');
		?>
	</head>
	
	<?php 
	// connexion à la bdd
	include ('functions/connexionBDD.php'); 
	?>
	
	<?php 
	//Controle de l'accès à la page
	if (isset($_SESSION['mail'])){
		//interdirAcces();
	}
	?>
	
	<body>
	
		<!-- Header -->
		<?php include ('sections/header.php'); ?>
		
		

		<!-- Page d'inscription -->
		<section class = "inscription" >
				<?php
				// Si on a appuyé sur le bouton "Valider"
				if (isset($_POST['submitInscription'])) {
					
					// Traitement des données
					if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['mdp'])){
						// Vérification que la donnée saisie pour l'email soit valide
								
							// Préparation de la requête d'ajout
							$inscrire = $bdd-> prepare('INSERT INTO patient (mailPatient, nomPatient, prenomPatient, motDePasse) VALUES (:mail, :nom, :prenom, :mdp)');
							$inscrire ->bindValue('mail', $_POST['mail'], PDO::PARAM_STR);
							$inscrire ->bindValue('nom', $_POST['nom'], PDO::PARAM_STR); 
							$inscrire ->bindValue('prenom', $_POST['prenom'], PDO::PARAM_STR);
							// Cryptage du mot de passe
							$mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
							$inscrire ->bindValue('mdp', $mdp, PDO::PARAM_STR);
							
							// Ajout du patient à la BDD
							$inscrire ->execute();
							$inscrire->closeCursor();
							
							//Connexion automatique du nouvel inscrit et redirection sur la page d'accueil
							$_SESSION["login"] = "OK";
							$_SESSION["username"] = $_POST['nom']." ".$_POST['prenom'];
							header("Location: pageAccueil.php");
							exit;
							
					} else {
				?>
						<p style = "color : red;"> Toutes les informations ne sont pas remplies. Vérifiez les champs du formulaire et essayez à nouveau ! </p>	
				<?php
					} 
				}
				?>
				
				<?php if (!isset($_POST['submitI'])){
				?>
				<h2> Inscription </h2> 
				<form  method="post" action="" class = "formInscription">                                        
							<div style = "display : flex;">
								<input type="text" name="prenom" placeholder = "Prénom" style="width : 197px; margin-right : 5px;"> 
								<input type="text" name="nom" placeholder = "Nom" style="width : 197px;">
							</div>
							<div>
								<input type="text" name="mail" placeholder = "Adresse mail" style="width : 400px;"> 
							</div>
							<div>
								<input type="password" name="mdp" placeholder = "Mot de passe" style="width : 400px;">
							</div>
							
<?php
							$req = $bdd->query('SELECT nom, prenom, idMedecin
								FROM Medecin
								ORDER BY Medecin.nom, Medecin.prenom;
							');
?>		
							<select name="IdMedecinReferent">
							<option value="0">Aucun médecin référent</option>
<?php	
								while ($donnees = $req->fetch()) {
?>		
									<option value="<?php echo $donnees['idMedecin'];?>">
										<?php echo $donnees['nom'] . " " . $donnees['prenom'];?>
									</option>
<?php					
								}
?>
							</select>
							
							
						<input type="submit" name = "submitInscription" value="Créer compte" style = "width : 100px; margin-left : 300px;"> 
				</form>
				<?php
					}else {
				?>
				<h2> Inscription </h2> 
				<form  method="post" action="" class = "formInscription">
							 <div style = "display : flex;">
								<input type="text" name="prenom" placeholder = "Prénom" value = "<?php echo $_POST['prenom'];?>" style="width : 197px; margin-right : 5px;"> 
								<input type="text" name="nom" placeholder = "Nom" value = "<?php echo $_POST['nom'];?>" style="width : 197px;">
							</div>
							<div>
								<input type="text" name="mail" placeholder = "Adresse mail" value = "<?php echo $_POST['mail'];?>" style="width : 400px;"> 
							</div>
							<div>
								<input type="password" name="mdp" placeholder = "Mot de passe" style="width : 400px;">
							</div>

							
<?php
							$req = $bdd->query('SELECT nom, prenom, idMedecin
								FROM medecin
								ORDER BY medecin.nom, medecin.prenom;
							');
?>			
							<select name="IdMedecinReferent">
							<option value="0">Aucun médecin référent</option>
<?php	
							while ($donnees = $req->fetch()) {
?>		
							<option value="<?php echo $donnees['idMedecin'];?>">
								<?php
									if($donnees['idMedecin'] == $_POST['IdMedecinReferent']) {
										echo ' selected="selected" ';
									}
								?>
							
								<?php echo $donnees['nom'] . " " . $donnees['prenom'];?>
							</option>
<?php					
							}
?>
							</select>
							
							
						<input type="submit" name = "submitInscription" value="Créer compte" style = "width : 100px; margin-left : 300px;"> 
				</form>		
				<?php 
					}
				?>
		</section>	
		
		

		<!-- Footer -->
		 <?php include("sections/footer.php"); ?>
		 
    </body>
	
	
</html>