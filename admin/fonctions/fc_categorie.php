<?php


//enregistrement de la nouvelle catégorie
function create_categorie($nom,$description,$etat){
	require("connexion.php");
	$verification = "SELECT * FROM categorie WHERE nom_cat='$nom'";
	$result0 = $con->query($verification);
	if($result0->rowcount() > 0){
			return "Cette catégorie existe déjà!";
	}else{
		$envoi = "INSERT INTO categorie(nom_cat,desc_cat,etat) VALUES('$nom','$description','$etat')";
		$result = $con->exec($envoi);
		if($result){	
			return true;
		}
	}

	return false;
}


//modifications
function update_categorie($nom,$description,$etat,$id){
	require("connexion.php");
	$update = "UPDATE categorie SET nom_cat = '$nom' , desc_cat = '$description' , etat = '$etat' WHERE id=$id";
	$result = $con -> exec($update);
	if($result){
		return true;
	}
	return false;

}

//liste des catégories
function list_categorie(){
	require("../connexion.php");
	$requet = "SELECT * FROM categorie";
	$result = $con->query($requet);
	if($result){
		return $result;
	}
	return "Aucune catégorie";
}
?>