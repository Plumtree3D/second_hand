<?php

ini_set('display_errors',1); error_reporting(E_ALL);

session_start();

$erreur ="";
if(isset($_POST["valider"])){

    require_once ("../class/class.user.php");
    $logUser = new Register();
    $logUser = $logUser->login($_POST["name"], $_POST["password"]);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/register.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body onLoad="document.fo.login.focus()">
    <h1>Authentification</h1>
    <div class="erreur"><?php echo $erreur ?></div>
    <form name="form" method="post" action="">
        <input type="text" name="name" placeholder="Nom d'utilisateur" /><br />
        <input type="password" id="password" name="password" placeholder="Mot de passe" /><br />
        <input type="checkbox" name="eye" id="eye" onclick="Afficher()"> Afficher le mot de passe <br />
        <input type="submit" name="valider" value="Se connecter" />
        <a href="register.php">Créer votre Compte</a>
    </form>

    <script>
    function Afficher() {
        var input = document.getElementById("password");
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
    </script>

</body>

</html>