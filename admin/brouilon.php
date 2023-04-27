<!DOCTYPE html> 
<html lang="fr"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <title>Transfert de fichiers</title> 
        </head> 
        <body> 
            <form action="" method="post" enctype="multipart/form-data" > 
                <fieldset> <input type="hidden" name="MAX_FILE_SIZE" value="100000" /> 
                <legend><b>Transfert de fichiers</b></legend> 
                <table> 
                    <tbody> 
                        <tr> 
                            <th>Fichier</th> 
                            <td><input type="text" name="name"/></td> 
                        </tr> 
                        <tr> 
                            <th>Fichier</th> 
                            <td><input type="file" name="fich" accept="image/png" size="50"/></td> 
                        </tr> 
                        <tr> 
                            <th>Clic !</th> 
                            <td> <input type="submit" value="Envoi" /></td> 
                            </tr> 
                    </tbody> 
                </table> 
                </fieldset> 
                </form> 
                <!-- Code PHP --> 
                <?php 
                if(isset($_FILES['fich'])) 
                {  
                    $envoie = upload($_FILES['fich'],$_POST['name']);
                    echo $envoie;
                    
                }

                function upload($file,$nom){
                    if(500000 == $_FILES["fich"]["size"])
                    {
                        foreach($_FILES["fich"] as $cle => $valeur) 
                        {  
                            echo "clé : $cle valeur : $valeur <br />"; 
                        } 
                        // Enregistrement et renommage du fichier 
                        $result=move_uploaded_file($_FILES["fich"]["tmp_name"],"imageProduit/". $nom .".png");
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