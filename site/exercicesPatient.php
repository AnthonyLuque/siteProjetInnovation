<?php include ('functions/logControlMedecin.php'); ?>


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
	
	
	<body>
	
		<!-- Header -->
		<?php include ('sections/header.php'); ?>
		
		

		<!-- Page d'exercices Patient -->
		<div class="body">
		
			<?php
				// Traitement des opérations de suppression et d'ajout avant l'affichage de la page
				
				if (isset($_POST['submitSuppression']) and !empty($_POST['idPatient']) and !empty($_POST['idExercice'])){
					$reqSuppression = $bdd-> prepare('DELETE FROM associationexcercicepatient WHERE idPatient = :idPatient AND idExercice = :idExercice');
					$reqSuppression->bindValue('idPatient', $_POST['idPatient'], PDO::PARAM_STR);
					$reqSuppression->bindValue('idExercice', $_POST['idExercice'], PDO::PARAM_STR);
					$reqSuppression->execute();
					$reqSuppression->closeCursor();
				}
			?>
			
			<?php
				if (isset($_POST['submitAjout']) and !empty($_POST['idPatient']) and !empty($_POST['idExercice'])){
					$reqAjout = $bdd-> prepare('INSERT INTO associationexcercicepatient (idPatient, idExercice) VALUES (:idPatient, :idExercice');
					$reqAjout->bindValue('idPatient', $_POST['idPatient'], PDO::PARAM_STR);
					$reqAjout->bindValue('idExercice', $_POST['idExercice'], PDO::PARAM_STR);
					$reqAjout->execute();
					$reqAjout->closeCursor();
				}
			?>
			
			
		
			<?php 
				// Si un Patient a été selectionné
				if (!empty($_POST['idPatient'])){ 
				
					$req = $bdd-> prepare('SELECT * FROM associationexcercicepatient,exercice WHERE idPatient = :idUtilisateur AND associationexcercicepatient.idExercice = exercice.idExercice ORDER BY exercice.nomExercice');
					$req->bindValue('idUtilisateur', $_POST['idPatient'], PDO::PARAM_STR);
					$req->execute();
					
					while($resultat = $req->fetch(PDO::FETCH_ASSOC)) {
			?> 
						<div class="ligneRequete"> 
							<div class="resultatRequete">
			<?php
								echo $resultat['nomExercice'];
			?> 			
							</div>
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

			?>
			
			<?php
					// On récupère les exercices restants pour proposer au medecin de les ajouter au patient
					
					/*
					$reqExercicesLeft = $bdd->prepare('SELECT * FROM exercice WHERE exercice.idExercice NOT IN (SELECT idExercice FROM associationexcercicepatient,exercice WHERE idPatient = :idUtilisateur AND associationexcercicepatient.idExercice = exercice.idExercice)');
					$reqExercicesLeft->bindValue('idUtilisateur', $_POST['idPatient'], PDO::PARAM_STR);
					$reqExercicesLeft->execute();
					
					select a.id from table1 as a where <condition> AND a.id NOT IN (select b.id from table2 as b where <condition>);
					
					SELECT * FROM Servicing_states ss WHERE NOT EXISTS ( SELECT * FROM Exception e WHERE ss.Service_Code = e.Service_Code);
					*/
					
					$reqExercicesLeft = $bdd->prepare('SELECT * FROM exercice WHERE exercice.idExercice NOT IN (SELECT idExercice FROM associationexcercicepatient,exercice WHERE idPatient = :idUtilisateur AND associationexcercicepatient.idExercice = exercice.idExercice)');
					$reqExercicesLeft->bindValue('idUtilisateur', $_POST['idPatient'], PDO::PARAM_STR);
					$reqExercicesLeft->execute();
					
					/*
					$num_rows = $reqExercicesLeft->rowCount();
					if($num_rows >= 1) {
					*/
?>						<form method="post" action="exercicesPatient.php">
							<div class="ajoutLigne"> 
								<div class="selectLigne">
									
									<input type="hidden" name="idPatient" value = "<?php echo $_POST['idPatient'];?>" />
									
									<select name="idExercice">
<?php	
										while ($donnees = $reqExercicesLeft->fetch(PDO::FETCH_ASSOC)) {
?>		
											<option value="<?php echo $donnees['idExercice'];?>"><?php echo $donnees['nomExercice'];?></option>
<?php					
										}
?>
									</select>
								</div>
								
								<div class="boutonsAjoutLigne">
									<input type="submit" name = "submitAjout" value="Ajouter" style="width : 160px">
								</div>
							</div>
						</form>
<?php					
					/*
					}
					*/
				
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