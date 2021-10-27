<?php

ini_set('display_errors',1); error_reporting(E_ALL);

require_once("../class/class.user.php");

session_start();

$erreur = "";

if (isset($_POST['inscrire'])){
    if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,50}$/',$_POST['password'])){
        $erreur = "Le mot de passe n'est pas conforme !";
    }
    elseif(empty($_POST["name"])) $erreur = "Le champs Nom d'utilisateur est obligatoire ! ";
    elseif(empty($_POST["firstname"]))$erreur = "Le champs Prénom est obligatoire ! ";
    elseif(empty($_POST["lastname"]))$erreur ="Le champs Nom est obligatoire !";
    elseif(empty($_POST["email"]))$erreur ="Le champs est Email obligatoire !";
    elseif(empty($_POST["password"]))$erreur ="Le champs est Mot de passe obligatoire !";
    else{
        $insertUser = new Register();
        $insertUser = $insertUser ->add($_POST["name"], $_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <h1>Inscription</h1>
    <div class="erreur"><?php echo $erreur ?></div>
    <form name="fo" method="post" action="">
        <input type="text" name="name" placeholder="Nom d'utilisateur"  /><br />
        <input type="text" name="firstname" placeholder="Prénom"  /><br />
        <input type="text" name="lastname" placeholder="Nom"  /><br />
        <input type="email" name="email" placeholder="Email" /><br />
        <input type="password" id="password" name="password"
            title="Au moins 8 caractères, un chiffre, une lettre majuscule, une lettre minuscule et un caractère spécial"
            placeholder="Mot de passe" /><br />
        <input type="checkbox" name="eye" id="eye" onclick="Afficher()"> Afficher le mot de passe <br />
        <input type="submit" name="inscrire" value="S'inscrire" />
        <a href="login.php">Deja un compte</a>
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