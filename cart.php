<?php 
    session_start();
    //suppresion
    if(isset($_GET['del']))
    {
        $id_del = $_GET['del'];
        unset($_SESSION['panier'][$id_del]);
 }

 //panier par défaut
if(!isset($_SESSION['panier'])){ $_SESSION['panier'] = array(); }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SHEYI - Accueil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets\vendor\bootstrap-icons\bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
<style>
    .photo{
        width: 100px;
        height: 80px;
    }

    .table tbody tr{
        align-items: center; 
    }

    .total{
        width: 100%;
        text-align: right;
        padding: 10px 30px;
    }

    .cart-title{
        width: 100%;
        text-align: center;
        text-transform: uppercase;
        padding: 50px 0;
    }

    .vide{
        width: 100%;
        text-align: center;  
        padding: 10vh 0 45vh 0;
        letter-spacing: 5px;
        font-size: 50px;
    }
</style>

</head>



<body>


<?php require('navbar.php'); ?>


    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <form action="cartManager.php" method="post">
        <div class="container cart">
            <div class="cart-title"> <p>Panier</p></div>
            <div class="cart-content">
        
                <?php
                    require("admin/connexion.php");
                    @$ids = array_keys($_SESSION['panier']);
                    if (!empty($ids)) {
                    ?>
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qauntité</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $req = $con -> query("SELECT * FROM produits WHERE id IN (".implode(',', $ids).")");
                        foreach ($req as $valeur) 
                        {
                            @$total = $total + ($valeur['prix']*$_SESSION['panier'][$valeur['id']]);
                                
                ?>
                        <tr>
                            <th > <img src="admin/imageProduit/<?= $valeur['photo'] ?>" alt="" srcset="" class="photo"> </th>
                            <td><?= $valeur['nom'] ?></td>
                            <td><?= $valeur['prix'] ?></td>
                            <td><?= $_SESSION['panier'][$valeur['id']]?></td>
                            <td><a href="cart.php?del=<?=$valeur['id']?>"><i class="bi bi-trash"></i></a></td>
                        </tr>
                <?php
                        }
                    }

                    if (empty($ids)) { 
                        ?>
                            <div class="vide">
                                <p>Votre  panier est vide !</p>
                            </div>
                        <?php        
                    }
                ?>
                </tbody>
            </table>
            <?php
            if (!empty($ids)) { 
                ?>
                    <!-- total -->
                        <div class="total">
                            <div class="total-title">Total : <?php if(@$total == 0){ echo 0;}else{ echo @$total;}  ?> Fcfa</div>
                        </div>
                            <!-- Buy button -->
                        <div class="row">
                            <form action="cartManager.php" method="post">
                                <input type="number" name="total" id="" hidden value="<?= $total ?>">
                                <button type="submit" class="btn btn-success mt-3 mb-3 buy-btn" name="commander">Commander</button>
                                <?php              
             }
             ?>
                </form>
                </div>
            </div>
        </div>
    </form>
    



    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">SHEYI</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            123 Consectetur at ligula 10660
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Catégories</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="index.php#categorie">Vetements</a></li>
                        <li><a class="text-decoration-none" href="index.php#categorie">Chaussures</a></li>
                        <li><a class="text-decoration-none" href="index.php#categorie">Accessories</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Guide</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Accueil</a></li>
                        <li><a class="text-decoration-none" href="index.php#service">Nos services</a></li>
                        <li><a class="text-decoration-none" href="index.php#categorie">Catégories</a></li>
                        <li><a class="text-decoration-none" href="Shop.php">Shop</a></li>
                        <li><a class="text-decoration-none" href="index.php#contact">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>