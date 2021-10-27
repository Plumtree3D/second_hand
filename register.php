<?php

require_once 'Databsae.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="GET">
        <input type="text" name="name">
        <input type="text" name="firstname">
        <input type="text" name="lastname">
        <input type="email" name="email">
        <input type="password" name="password">
        <input type="submit" name="action" value="connexion">
    </form>
    
</body>

</html>