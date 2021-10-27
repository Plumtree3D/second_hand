<?php session_start();

if(isset($_SESSION["connected"])){
    header("location: connect.php");
}else{
    header("location: login.php");
}
?>