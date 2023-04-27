<?php

	//connexion a la base de donnée
	try {
		$con = new PDO("mysql:host=localhost;dbname=projetsheyi","root","");
		/*if($con){
			echo "connexion";
		}*/	
	} catch (Exception $e) {
		echo "Erreur : ".$e;
			
		}	

?>