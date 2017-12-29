<div class="menuNavigation">
	<a href="accueil.php">Accueil</a>
	<a href="exercices.php">Exercices</a>
	
	<?php
	// Si un utilisateur est connecté
	if (isset($_SESSION['login'])){
		
		// Si l'utilisateur est un Patient
		if ($_SESSION['login'] == "Patient"){
	?>			
			<a href="statistiques.php">Statistiques</a>
	<?php			
		} else {
	?>			
			<a href="suiviClient.php">Suivi Patients</a>
	<?php			
		}
	}
	?>
	
</div> 