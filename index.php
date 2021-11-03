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
        <input type="submit" name="su" value="valider">
    </form>
</div>
<div class="order">
    <tr>
        <form action="" method="post">
            <th><button>Trier par date</button>
        </form>
        </th>
        <form action="" method="post">
            <th><button>Trier par prix</button>
        </form>
        </th>
    </tr>
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
                    <img src="user_images/<?=$truc['posting_id']?>/1.jpg">
                </div>
                  
            </div>
            
            <div class=" column centerpart">
                <a href=<?="'posting.php?post=".$truc['posting_id']."'"?> target="_blank"><p> <strong> <?php echo $truc['posting_title']; ?> </strong>  </p> </a>
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
<?php endforeach ?>



<?php include 'footer.html' ?>


</body>

</html>