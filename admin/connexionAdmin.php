<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif
        }
        .row{
            display: flex;
            width: 100%;
        }

        .row .col-6{
            width: 50%;
            text-align: center;
        }

        .logo{
            background-color: #59ab6a;
        }

        .logo h1{
            color: white;
            font-weight: 900;
            font-size: 55px;
            margin-top: calc(100% - 60%);
            font-weight: 500 !important;
            font-family: 'Roboto', sans-serif
        }

        .form, .logo{
            height: 100vh;
        }

        .line{
            width: 100%;
            margin: 0 0 15px 0;
        }

        .line input{
            width: 50%;
            outline: none;
            padding: 10px;
        }

        .form h1{
            margin-top: calc(100% - 75%);
            margin-bottom: 30px;
            font-size: 55px;
            color: #59ab6a;
            text-transform: uppercase;
        }

        .form form button{
            padding: 10px 0;
            width: 50%;
            margin: 12px 0 12px 0;
            background-color: #59ab6a;
            border-style: none;
            color: white;
            font-family: bold;
            text-transform: uppercase;
        }

        .lien{
            font-size: 12px;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-6 logo">
            <h1>SHEYI</h1>
        </div>
        <div class="col-6 form">
            <h1>Connexion</h1>
            <form action="traitement.php" method="post">
                <div class="line">
                    <input type="email" name="email" id="" placeholder="Entrer votre email">
                </div>
                <div class="line">
                    <input type="password" name="pwd" id="" placeholder="Entrer votre mot de passe">
                </div>
                <div class="footer">
                    <button type="submit" name="connexionAdmin">Connection</button>
                </div>
                    <a href="" class="lien">Mot de passe oublié ?</a>
            </form>
        </div>
    </div>
</body>

</html>