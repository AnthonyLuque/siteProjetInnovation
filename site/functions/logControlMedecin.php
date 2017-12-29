<?php
	session_start();

	if( !( isset($_SESSION['login']) && $_SESSION['login'] == "Medecin" ) ) {
		header("Location: connexion.php");
		exit;
	}
?>
