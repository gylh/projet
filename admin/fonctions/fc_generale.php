<?php 


function redirection($target){
		header("Location:$target");
}

function redirectionWithObject($objet, $target){

	foreach ($objet as $objet) {
		$_SESSION['nom'] = $objet['nom_cat'];
		$_SESSION['description'] = $objet['desc_cat'];
	    $_SESSION['etat'] = $objet['etat'];
		$_SESSION['id'] = $objet['id'];
		header("Location:$target");
	}

}

function redirectionWithObjectProd($objet, $target){

	foreach ($objet as $objet) {
		$_SESSION['id'] = $objet['id'];
		$_SESSION['nom'] = $objet['nom'];
		$_SESSION['categorie'] = $objet['categorie'];
		$_SESSION['description'] = $objet['description'];
		$_SESSION['prix'] = $objet['prix'];
		$_SESSION['couleur'] = $objet['couleur'];
		$_SESSION['taille'] = $objet['taille'];
		@$_SESSION['photo'] = $objet['photo'];
		$_SESSION['stock'] = $objet['stock'];
		header("Location:$target");
	}

}


function searchWithId($id,$table){
	require("connexion.php");
	if (!empty($id)) {
		$search = "SELECT * FROM $table WHERE id = $id";
		$item = $con -> query($search);
		if ($item->rowcount() > 0) {
		 	return $item;
		 }
		 return false; 
	}

}


function delete($id,$table,$target){
	require("connexion.php");
	if (!empty($id)) {
		$search = "SELECT * FROM $table WHERE id = $id";
		$item = $con -> query($search);
		if ($item->rowcount() > 0) {
		 	$delete = "DELETE FROM $table WHERE id = $id";
			$execut = $con -> exec($delete);
			if($execut){
				redirection($target);
			}
		 }
	}

}

function select($table){
	require("../connexion.php");
	$query = "SELECT * FROM $table";
	$result = $con -> query($query);
	if ($result) {
		return $result;
	}
	return false;
}
function upload($file,$nom){
	if($_FILES["fich"]["size"] <= 500000 )
	{
		foreach($_FILES["fich"] as $cle => $valeur) 
		{  
			echo "clé : $cle valeur : $valeur <br />"; 
		} 
		// Enregistrement et renommage du fichier 
		$result=move_uploaded_file($_FILES["fich"]["tmp_name"], "imageProduit/".$nom.".png");
		if($result==TRUE)  
		{
			echo "<hr /><big>Le transfert est effectué !</big>";
		}
		else  
		{
			echo "<hr /> Erreur de transfert n°",$_FILES["fich"]["error"];
		}
	}else{
		echo "<p>Le fichier que vous essayer d'envoyer est supérieur à la valeur autorisé <br>
		La valeur maximale autorisée est : 500 000 octets</p>";
	}
}

?>