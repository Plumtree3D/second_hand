<?php 

ini_set('display_errors',1); error_reporting(E_ALL);

$pageTitle = "Accueil | Second Hand";
include 'head.php';
include 'header.html';
require_once 'class/class.postings.php';
require_once 'class/class.database.php';
?>

<?php
// $connect = new Database();
// $connect = $connect->connect();


?>

<div id="search">
    <form method="get" action="" name="forms" id="searchform" >
        <input type="text" name="search" placeholder="Rechercher une annonce">
        <input type="submit" name="su" value="valider">
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
        <p> <strong> <?php echo $truc['posting_title']; ?> </strong> </p>
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



<footer>
    <p> LE FOOTER </p>
</footer>


</body>

</html>