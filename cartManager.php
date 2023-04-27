<?php
//inclure la page de connexion
include_once('admin/connexion.php');
//création d'une session
if(!isset($_SESSION)){ session_start(); }
//panier par défaut
if(!isset($_SESSION['panier'])){ $_SESSION['panier'] = array(); }

if(isset($_GET['id']) && !empty($_GET['id']))
{
    //verifions si le produit existe
    $id = $_GET['id'];
    $req = $con-> prepare("SELECT * FROM produits WHERE id = ?");
    $res = $req -> execute(array($id));

    if($req->rowCount() == 0)
    {
        header('Location:erreur_produit.php');
    }

    if(isset($_SESSION['panier'][$id])){ 
        $_SESSION['panier'][$id]++;
    }
    else{
        $_SESSION['panier'][$id] = 1;
    }

    header('Location:shop.php#'.$id);
    
}

if (isset($_POST['commander'])) {
    $_SESSION['total'] = $_POST['total'];
    @$ids = array_keys($_SESSION['panier']);
    if (!empty($ids)) {
        for ($i=0; $i < count($ids); $i++) { 
            @$id[$i] = $ids[$i];
        }
    }
    $_SESSION['commande'] =implode('/',$id);
    header('Location:client.php');
}

if (isset($_POST['send'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $address = htmlspecialchars($_POST['address']);
    $num = htmlspecialchars($_POST['num']);
    echo $command = $_SESSION['commande'];
    if (!empty($nom) && !empty($address) && !empty($num)) {
        $envoi = "INSERT INTO client(nom,addresse,num) VALUES('$nom','$address','$num')";
        $result = $con->exec($envoi);
        if ($result) {
            $seach = "SELECT * FROM client WHERE nom='$nom' AND num='$num'";
            $result1 = $con->query($seach);
            if ($result1) {
                foreach ($result1 as $value) {
                   $idClient = $value['id'];
                }
                $date = date("d/m/Y \à H:i:s");;
                $command = $_SESSION['commande'];
                $toto = $_SESSION['total'];
                $commande = "INSERT INTO commande(produit,total,idClient,statut,createdDate) VALUES('".$_SESSION['commande']."','$toto','$idClient','Non livrer','$date')";
                
                if ($resutl2 = $con->exec($commande)    ) {
                    $seach1 = "SELECT * FROM commande WHERE total='$toto' AND idClient='$idClient'";
                    $result3 = $con->query($seach1);
                    if ($result3) {
                        foreach ($result3 as $value) {
                            $idCommande = $value['id'];
                         }
                        session_destroy();
                        header('Location:https://wa.me/22961798082?text="Bonjour,%20je%20viens%20d\'effectué%20une%20commande%20sur%20votre%20site%20SHEYI.');
                    }
                }
            }else {
                echo 'je suis là';
            }
        }
    }else {
        header('Location:shop.php');
    }
}
?>