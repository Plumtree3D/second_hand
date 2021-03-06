<?php 

$pageTitle = "Accueil";

include 'head.php';
include 'header.php';
require_once 'class/class.postings.php';
require_once 'class/class.database.php';
?>

<?php
// $connect = new Database();
// $connect = $connect->connect();
?>

<div class="search">
    <form method="get" action="" name="forms" id="searchform">
        <input type="text" name="search" placeholder="Rechercher une annonce">
        <input type="text" name="localisation" placeholder="Rechercher par localisation">
        <select name="categories">
            <option value="">--- Choisir une catégorie ---</option>
            <option value="1">Immobilier</option>
            <option value="2">Véhicule</option>
            <option value="3">Multimédia</option>
        </select>
        <input type="submit" name="su" value="valider">
    </form>
</div>

<div class="order">
    <form action="" method="post">
        <input type="submit" name="dateC" value="Date croissante">
    </form>
    <form action="" method="post">
        <input type="submit" name="dateD" value="Date décroissante">
    </form>
    <form action="" method="post">
        <input type="submit" name="prixC" value="Prix croissant">
    </form>
    <form action="" method="post">
        <input type="submit" name="prixD" value="Prix décroissant">
    </form>
</div>

<?php 

// Recherche textuel
    if(!isset($_GET['search'])||(empty($_GET['search']))){
        $select = new Posting();
        $select = $select->select();
    }else{
        $select = new Posting();
        $select = $select->search();
    }

// Recherche localisation
    if(!isset($_GET['localisation'])||(empty($_GET['localisation']))){
        $select = new Posting();
        $select = $select->select();
    }else{
        $select = new Posting();
        $select = $select->localisation();
    }

// Recherche catégorie 
    $option = $_GET['categories'];
    if($option == 1){
        $select = new Posting();
        $select = $select->catImmo();
    }elseif($option == 2){
        $select = new Posting();
        $select = $select->catVehicle();
    }elseif($option == 3){
        $select = new Posting();
        $select = $select->catMedia();
    }


    if(isset($_POST['prixC'])){
        $select = new Posting();
        $select = $select->orderPriceC();
    }
    if(isset($_POST['prixD'])){
        $select = new Posting();
        $select = $select->orderPriceD();
    }
    if(isset($_POST['dateC'])){
        $select = new Posting();
        $select = $select->orderDateC();
    }
    if(isset($_POST['dateD'])){
        $select = new Posting();
        $select = $select->orderDateD();
    }

    foreach($select as $truc) :
    
    ?>


<div class="post">
    <div class="column">
        <div class="placeholder">
            <img src="user_images/<?=$truc['posting_id']?>/1.jpg">
        </div>

    </div>

    <div class=" column centerpart">
        <a href=<?="'posting.php?post=".$truc['posting_id']."'"?> target="_blank">
            <p> <strong> <?php echo $truc['posting_title']; ?> </strong> </p>
        </a>
        <span> <img src="images/map_marker.svg" alt=""> <?php echo $truc['posting_loc']; ?> </span>

        <div class="description">
            <?php echo $truc['posting_desc']; ?>
        </div>

        <span> <img src="images/user-alt.svg" alt=""> <strong> <?php echo $truc['user_name']; ?> </strong> </span>
    </div>
    <div class="column price">
        <span><?php echo $truc['posting_price']; ?> € </span>
    </div>
</div>
<?php endforeach ?>

<?php include 'footer.html' ?>

</body>

</html>