<?php


//enregistrement d'un nouveu produit
function create_produit($nom,$categorie,$description,$prix,$couleur,$taille,$photo,$stock){
	require("connexion.php");
	$verification = "SELECT * FROM produits WHERE nom='$nom'";
	$result0 = $con->query($verification);
	if($result0->rowcount() > 0){
			return "Cette produit existe déjà!";
	}else{
		$envoi = "INSERT INTO produits(nom,categorie,description,prix,couleur,taille,photo,stock) VALUES('$nom','$categorie','$description','$prix','$couleur','$taille','$photo','$stock')";
		$result = $con->exec($envoi);
		if($result){	
			return true;
		}
	}

	return false;
}


//modifications
function update_categori($nom,$description,$etat,$id){
	require("connexion.php");
	$update = "UPDATE produit SET nom_cat = '$nom' , desc_cat = '$description' , etat = '$etat' WHERE id=$id";
	$result = $con -> exec($update);
	if($result){
		return true;
	}
	return false;

}

//liste des produits
function list_produit(){
	require("../connexion.php");
	$requet = "SELECT * FROM produits";
	$result = $con->query($requet);
	if($result){
		return $result;
	}
	return "Aucune catégorie";
}


//modifications
function update_produit($nom,$categorie,$description,$prix,$couleur,$taille,$stock,$id){
	require("connexion.php");
	$update = "UPDATE produits SET nom ='$nom',categorie='$categorie',description='$description',prix='$prix',couleur='$couleur',taille='$taille',stock='$stock' WHERE id=$id";
	$result = $con -> exec($update);
	if($result){
		return true;
	}
	return false;

}

?>