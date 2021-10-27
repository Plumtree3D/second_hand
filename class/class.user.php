<?php

ini_set('display_errors',1); error_reporting(E_ALL);

require_once 'class.database.php';

class Register extends Database{

    private $name; 
    private $firstname;
    private $lastname;
    private $email; 
    private $password;
    

    public function add($name, $firstname, $lastname, $email, $password){

        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password = password_hash($password, PASSWORD_DEFAULT);

        $verify_name = $this->connect()->prepare("SELECT user_id FROM user WHERE user_name=? LIMIT 1");
        $verify_name->execute(array($name));
        $user_name = $verify_name->fetchAll();
        if (count($user_name) > 0)
        $erreur = "Pseudo déja utilisé!";
        else {
        $insert = $this->connect()->prepare("INSERT INTO user(`user_name`, `user_firstname`, `user_lastname`, `user_email`, `user_pwd`) VALUES(:username,:firstname,:lastname,:email,:password)");
        $insert->bindValue(":username",$name);
        $insert->bindValue(":firstname",$firstname);
        $insert->bindValue(":lastname",$lastname);
        $insert->bindValue(":email",$email);
        $insert->bindValue(":password",$password);
        $insert->execute();
  
        header("location: login.php");
             }
    }


    public function login($name, $password){

        $name = $_POST["name"];
        $password = $_POST["password"];
        
       
        $verify = $this->connect()->prepare('SELECT * FROM user WHERE user_name=?');
        $verify->execute(array($name));
        $user = $verify->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)){
            if(password_verify($password, $user["user_pwd"])) {
                $_SESSION["firstname_lastname"] = $user["user_firstname"] . $user["user_lastname"];
                $_SESSION["connecter"] = "yes";
                $_SESSION["user_id"] = $user["user_id"];

                header("location: ../profile.php");
        } else {
            echo "Mot de passe incorect espèce de grosse merde c'est pour ça que tes parents t'on déshérité";
        }


        } else
        $erreur = "Mauvais nom d'utilisateur ou mot de passe !";
    }
    
}