<?php 

$pageTitle = "Accueil";

include 'head.php';
include 'header.html';
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
        <input type="submit" name="su" value="valider">
    </form>
</div>

<div class="choix">
    <form method="post">
        <select name="categories" id="">
            <option value="Immobilier">Immobilier</option>
            <option value="Véhicule">Véhicule</option>
            <option value="Multimédia">Multimédia</option>
        </select>
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
    if(!isset($_GET['search'])||(empty($_GET['search']))){
        $select = new Posting();
        $select = $select->select();
    }else{
        $select = new Posting();
        $select = $select->search();
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
            <?php 
                    if(!is_null($truc['picture_name'])) {
                    echo '<img src="user_images/'.$truc['picture_name'].'">'; } 
                    ?>
        </div>

    </div>

    <div class=" column centerpart">
        <a href=<?="'posting.php?=".$truc['posting_id']."'"?> target="blank">
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