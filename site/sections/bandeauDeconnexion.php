<?php 
	if($_SESSION['login'] == "Medecin") {
?>
		<form action = "inscription.php" method = "post" >
			<input class="button" type="submit" name = "inscrirePatient" value="Inscrire Patient"/>
		</form>
<?php	
	}
?>

<form action = "" method = "post" >
	<input class="button" type="submit" name = "deconnexion" value="Se déconnecter"/>
</form>

<?php 
	if (isset($_POST['deconnexion'])){
		session_destroy();
		header("Location: accueil.php");
		exit;
	}
?>