<?php 
	session_start();
?>


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
		
		

		<!-- Page d'accueil -->
		<div class="body">
		
			
		
		</div>
		

		<!-- Footer -->
		 <?php include("sections/footer.php"); ?>
		 
    </body>
	
	
</html>