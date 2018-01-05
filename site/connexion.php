<?php 
	session_start();
?>


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
	// Connexion à la bdd
	include ('functions/connexionBDD.php'); 
	?>
	
	
	<body>
	
		<!-- Header -->
		<?php include ('sections/header.php'); ?>
		
		

		<!-- Page de connexion -->
		<div class="body">
		
			<?php 
			if(!isset($_POST['submitConnexion'])){
			?>
				<form method="post" action="connexion.php" align="center">
					<input type="text" name="username" placeholder = "Username / e-mail" style="width : 250px;"/> <br />
					<input type="password" name="password" placeholder = "Password" style="width : 250px;"> <br />
				
					<input type="submit" name = "submitConnexion" value="Se Connecter" style="width : 160px">
				</form>	
			<?php
			} else {
			?>
				<form method="post" action="connexion.php" align="center">
					<input type="text" name="username" placeholder = "Username" value = "<?php echo $_POST['username'];?>" style="width : 250px;"> <br />
					<input type="password" name="password" placeholder = "Password" style="width : 250px;"> <br />
				
					<input type="submit" name = "submitConnexion" value="Se connecter" style="width : 160px">
				</form>	
			<?php		
			}
			?>
			
		</div>
		
		
		<?php 
		if(isset($_POST['username']) and isset($_POST['password'])){
			$req = $bdd-> prepare('SELECT * FROM utilisateur WHERE mailUtilisateur = :username and motDePasse = :password');
			$req->bindValue('username', $_POST['username'], PDO::PARAM_STR);
			$req->bindValue('password', $_POST['password'], PDO::PARAM_STR);
			$req->execute();
			$resultat = $req->fetch(PDO::FETCH_ASSOC);
								
			if($req == false) {
				echo 'Error: cannot execute query';
				exit;
			}

			$num_rows = $req->rowCount();
			if($num_rows == 1) {
				$_SESSION['username'] = $resultat['mailUtilisateur'];
				$_SESSION['idUtilisateur'] = $resultat['idUtilisateur'];
				if($resultat['estMedecin']) {
					$_SESSION['login'] = "Medecin";
				} else {
					$_SESSION['login'] = "Patient";
				}
				$redirect = "accueil.php";
			} else {
				$redirect = "connexion.php";
			}
			 
			$req->closeCursor();

			header("Location: $redirect");
		}
		?>
		

		<!-- Footer -->
		 <?php include("sections/footer.php"); ?>
		 
    </body>
	
	
</html>