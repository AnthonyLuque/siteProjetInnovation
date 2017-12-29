<?php
	session_start();

	if( !( isset($_SESSION['login']) && ($_SESSION['login'] == "Medecin" || $_SESSION['login'] == "Patient") ) ) {
		header("Location: connexion.php");
		exit;
	}
?>
