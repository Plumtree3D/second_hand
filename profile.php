<?php
session_start();

$pageTitle = $_SESSION['username'];
include 'head.php';
include 'header.html';
require_once 'class/class.postings.php';

if($_SESSION["connecter"] != "yes"){
    header("location: login/login.php");
    exit();
}



if (date("H") < 18)
$bienvenue = 'Bonjour ' .
$_SESSION["firstname"]. " !";
else
$bienvenue = "Bonsoir " .
$_SESSION["firstname"]. " !";


?>



<body>
<div class="profile">
    <p><?php echo $bienvenue ?></p>
    <div class="profileBanner">

        <div class = "profilePicture">
            <?php 
                if(!empty($_SESSION['profilepicture'])) {
                $profilePicture = $_SESSION['profilepicture'];
                echo '<img src="user_images/'.$profilePicture.'" width="160" height="160">'; 
                } else {
                echo '<img src="images/placeholder.png" width="160">';   

                }
            ?>
        </div>


        <span>  Profil de <?= $_SESSION['username']; ?> <td> </span>

        
        <a  href="login/logout.php">Déconnexion</a>
        

    </div>


    

    <h2> Vos annonces: </h2>

    <?php 
    $userPostings = new Posting();
    $userPostings = $userPostings->userPostings();
    if(!empty($userPostings)) {

        foreach($userPostings as $truc) : 
            ?>
                <div class="post">
                    <div class="column">
                        <div class="placeholder">
                            <?php 
                            if(!is_null($truc['picture_name'])) {
                            echo '<img src="user_images/'.$truc['picture_name'].'">'; } 
                            ?>
                        </div>
                          
                    </div>
                    <div class=" column centerpart">
                        <p> <strong> <?php echo $truc['posting_title']; ?> </strong>  </p>
                        <span> <img src="images/map_marker.svg" alt=""> <?php echo $truc['posting_loc']; ?> </span>
        
                        <div class="description">
                             <?php echo $truc['posting_desc']; ?> 
                        </div>
        
                        <span> <img src="images/user-alt.svg" alt=""> <strong> <?php echo $truc['user_name']; ?> </strong>  </span>
                    </div>
                    <div class="column price">
                        <span><?php echo $truc['posting_price']; ?> € </span>
                    </div>
        
                    
        
                                       
                </div>
            <?php endforeach;

    } else { ?>
    <div class="profileMessage">
        <div class="justify">
            <p> On dirait que vous n'avez pas encore publié d'annonces 😕 <br>  Vendez quelque chose dès maintenant ! 
            </p>
            <a href="createpost.php" class="createPost">  Ajouter une annonce </a>
        </div>
    </div>
        

    <?php } ?>
    



    <br>
</div>

<?php include 'footer.html' ?>
    </body>
</html>