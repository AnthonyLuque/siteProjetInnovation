	<?php
		try{
			$bdd = new PDO('mysql:host=localhost:8889;dbname=projetinnovant;charset=utf8', 'root', 'root');
		}
		catch (Exception $e){
				die('Error : ' . $e->getMessage());
		}
	?>