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
		
		<style>
			.accordion {
				display: block;
				background-color: #3cabbc;
				color: white;
				font-family: 'Open Sans', sans-serif;
				cursor: pointer;
				font-size:16px;
				border: none;
				outline: none;
				
				padding: 12px 26px;
				text-decoration: none;
				margin: 0px;
				margin-bottom: 0;
				margin-left: auto;
				margin-right: auto;
				width: 80%;
				transition: 0.4s;
			}

			.active, .accordion:hover {
				background-color: #308896;
			}

			.accordion:after {
				content: '\002B';
				color: white;
				font-weight: bold;
				float: right;
				margin-left: 5px;
			}

			.active:after {
				content: "\2212";
			}

			.panel {
				display: block;
				background-color: #ccc;
				padding: 0 18px;
				margin: 0;
				margin-left: auto;
				margin-right: auto;
				max-height: 0;
				width: 80%;
				overflow: hidden;
				transition: max-height 0.2s ease-out;
			}
		</style>
	</head>
	
	
	<?php 
	// connexion à la bdd
	include ('functions/connexionBDD.php'); 
	?>
	
	<body>
	
		<!-- Header -->
		<?php include ('sections/header.php'); ?>
		

		
		<!-- Page d'exercices -->
		<div class="body">
		
			<?php 
				// Si l'utilisateur est un Patient
				if ($_SESSION['login'] == "Patient"){ 
				
					$req = $bdd-> prepare('SELECT * FROM associationexcercicepatient,exercice WHERE idPatient = :idUtilisateur AND associationexcercicepatient.idExercice = exercice.idExercice ORDER BY exercice.nomExercice');
					$req->bindValue('idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_STR);
					$req->execute();
					
					while($resultat = $req->fetch(PDO::FETCH_ASSOC)) {
			?> 
						<div class="resultatRequete"> 
			<?php
							echo $resultat['nomExercice']; 
			?> 
						</div> 
			<?php
					}

				// Si l'utilisateur est un Medecin
				} else {

					$req = $bdd-> prepare('SELECT * FROM exercice ORDER BY exercice.nomExercice');
					$req->execute();
					
					while($resultat = $req->fetch(PDO::FETCH_ASSOC)) {
			?> 
							<button class="accordion">
			<?php
								echo $resultat['nomExercice']; 
			?> 
							</button>
							<div class="panel">
			<?php
								echo "[Résultat Requête] Description de l'exercice."; 
			?> 							
							</div>
			<?php
					}
				
				}
			?>
			
		</div>
		

		<script>
			var acc = document.getElementsByClassName("accordion");
			var i;

			for (i = 0; i < acc.length; i++) {
			  acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight){
				  panel.style.maxHeight = null;
				} else {
				  panel.style.maxHeight = panel.scrollHeight + "px";
				} 
			  });
			}
		</script>
		

		<!-- Footer -->
		 <?php include("sections/footer.php"); ?>
		 
    </body>
	
	
</html>