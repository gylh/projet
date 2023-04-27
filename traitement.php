<?php
include('admin/connexion.php');
include('admin/fonctions/fc_generale.php');
if (isset($_POST['envoyer'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $objet = htmlspecialchars($_POST['objet']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);


    if (!empty($nom) && !empty($objet) && !empty($email) && !empty($message)) {
        
        
        if($con->exec("INSERT INTO contact(nom,email,objet,message) VALUES('$nom','$email','$objet','$message')")){
            redirection("merci.php");
        }else {
            redirection("index.php");
        }
    }else {
        redirection("index.php#contact");
    }
}


//liste des produits
function list_product(){
	require("admin/connexion.php");
	$requet = "SELECT * FROM produits";
	$result = $con->query($requet);
	if($result){
		return $result;
	}
	return "Aucun produit";
}
function recuperation($id,$table){
    require("admin/connexion.php");
    $requete = "SELECT * FROM $table WHERE id = $id";
    $result = $con->query($requete);  
 
    if($result){
        return $result;
    }else{
        return false;
    }
}

?>