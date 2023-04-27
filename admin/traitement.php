<?php 

require("fonctions/fc_categorie.php");
require("fonctions/fc_produit.php");
require("fonctions/fc_generale.php");

//CATEGORIE
//création de la catégorie
if(isset($_POST['btn_create_categorie'])){
	$nom = htmlspecialchars($_POST['nom']);
	$description = htmlspecialchars($_POST['description']);
	$etat = htmlspecialchars($_POST['etat']);
	if(!empty($nom) && !empty($description)){
		$save = create_categorie($nom,$description,$etat);
		if(($save === true) ){
			redirection("categorie/list_categorie.php");
		}else if($save === false){
			echo "Impossible d'enregister cette catégorie.";
		}else{
			echo $save;
		}
	}else{
		echo "Veuillez remplire convenablement les champs!";
	}
}

//ajouter une catégorie
if(isset($_POST['addCategorie'])){
	redirection('categorie/create_categorie.php');
}

//modification categorie
if(isset($_POST['btn_update_categorie'])){
	if (!empty($_POST['id'])) {
		$id = $_POST['id'];
		$objet = searchWithId($id,"categorie");
		if($objet){
			redirectionWithObject($objet,"categorie/update_categorie.php");
		}else{
			echo "pas d'objet";
		}
		
	}
}

//récupération des datas pour modification et sauvegarde
if(isset($_POST['btn_saveUpdate_categorie'])){
	$nom = htmlspecialchars($_POST['nom']);
	$description = htmlspecialchars($_POST['description']);
	$etat = htmlspecialchars($_POST['etat']);
	$id = htmlspecialchars($_POST['id']);
	if(!empty($nom) && !empty($description)){
		$save = update_categorie($nom,$description,$etat,$id);
		if($save){
			// echo "Modification éffectué";
			redirection("categorie/list_categorie.php");
		}else{
			echo "ici";
		}
	}else{
		echo "Echec de la modification!";
	}
}

//suppression d'une catégorie
if(isset($_POST['btn_delete_categorie'])){
	delete($_POST['id'],"categorie","categorie/list_categorie.php");
}


//PRODUITS
//création d'un produit
if(isset($_POST['btn_create_produit']))
{

	$nom = htmlspecialchars($_POST['nom']);
	$categorie = htmlspecialchars($_POST['categorie']);
	$description = htmlspecialchars($_POST['description']);
	$prix = htmlspecialchars($_POST['prix']);
	$couleur = htmlspecialchars($_POST['couleur']);
	$taille = htmlspecialchars($_POST['taille']);
	$stock = htmlspecialchars($_POST['stock']);

	if(isset($_FILES['fich'])) 
    {  
        $envoie = upload($_FILES['fich'],$nom);
        echo $envoie;
		$photo = $nom.".png";
		if(!empty($nom) && !empty($categorie) && !empty($description) && !empty($prix) && !empty($couleur) && !empty($taille) && !empty($stock))
		{
			$save = create_produit($nom,$categorie,$description,$prix,$couleur,$taille,$photo,$stock);
			if(($save === true) ){
				redirection("produit/list_produit.php");
			}else if($save === false){
				echo "Impossible d'enregister cette catégorie.";
			}else{
				echo $save;
			}
		}else{
			echo "Veuillez remplire convenablement les champs!";
		}
    }else
	{
		redirection("create_produit.php");
	}	
}

//ajouter un produit
if(isset($_POST['addProduit'])){
	redirection('produit/create_produit.php');
}

//suppression d'un produit
if(isset($_POST['btn_delete_produit'])){
	delete($_POST['id'],"produits","produit/list_produit.php");
}

//modification produit
if(isset($_POST['btn_update_produit'])){
	if (!empty($_POST['id'])) {
		$id = $_POST['id'];
		$objet = searchWithId($id,"produits");
		if($objet){
			redirectionWithObjectProd($objet,"produit/update_produit.php");
		}else{
			echo "pas d'objet";
		}
		
	}
}

//récupération des datas pour modification et sauvegarde
if(isset($_POST['btn_saveUpdate_produit'])){
	$id = htmlspecialchars($_POST['id']);
	$nom = htmlspecialchars($_POST['nom']);
	$categorie = htmlspecialchars($_POST['categorie']);
	$description = htmlspecialchars($_POST['description']);
	$prix = htmlspecialchars($_POST['prix']);
	$couleur = htmlspecialchars($_POST['couleur']);
	$taille = htmlspecialchars($_POST['taille']);
	$stock = htmlspecialchars($_POST['stock']);
	@$photo = htmlspecialchars($_POST['photo']);
	if(!empty($nom) && !empty($categorie) && !empty($description) && !empty($prix) && !empty($couleur) && !empty($taille) && !empty($stock) && !empty($id))
	{
		$save = update_produit($nom,$categorie,$description,$prix,$couleur,$taille,$stock,$id);
		if($save){
			// echo "Modification éffectué";
			redirection("produit/list_produit.php");
		}else{
			echo "ici";
		}
	}else{
		echo "Echec de la modification!";
	}
}


// formulaire d'inscription de l'admin
if(isset($_POST['enrgistrerAdmin'])){
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$email = htmlspecialchars($_POST['email']);
	@$pwd = htmlspecialchars($_POST['password']);
	$dateCreated = date("d/m/Y \à H:i:s");

	if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($pwd)) {
		include('connexion.php');
		$envoi = "INSERT INTO admin(nom,prenom,mail,pwd,date) VALUE('$nom','$prenom','$email','$pwd','$dateCreated')";
		$verif = $con->exec($envoi);
		if ($verif) {
			header('Location:index.php');
		}
	}else {
		echo 'remplissage';
	}
}

//connexion de l'administrateur

if (isset($_POST['connexionAdmin'])) {
	$email = htmlspecialchars($_POST['email']);
	@$pwd = htmlspecialchars($_POST['pwd'] );

	if (!empty($email) && !empty($pwd)) {
		include('connexion.php');
		$seachAdmin = "SELECT * FROM admin WHERE mail ='$email' && pwd='$pwd' ";
		$response = $con->query($seachAdmin);
		if ($response->rowCount() > 0 ) {
			echo 'cc';
		}
		else {
			echo $response->rowCount();
			echo $pwd;
		}
	}
}


?>