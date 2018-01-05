	<?php
		try{
			$bdd = new PDO('mysql:host=localhost:3306;dbname=projetinnovant;charset=utf8', 'root', '');
		}
		catch (Exception $e){
				die('Error : ' . $e->getMessage());
		}
	?>