<?php

session_start();
if($_SESSION["connecter"] != "yes"){
    header("location: login.php");
    exit();
}
if (date("H") < 18)
$bienvenue = "Bonjour et bienvenue" .
$_SESSION["firstname_lastname"];
else
$bienvenue = "Bonsoir et bienvenue " .
$_SESSION["firstname_lastname"];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session</title>
    <link rel="stylesheet" href="css/session.css">
</head>
<body onLOad="document.fo.login.focus()">
    <h2><?php echo $bienvenue ?></h2>
    <a  href="logout.php">Se déconnecter</a>
</body>
</html>