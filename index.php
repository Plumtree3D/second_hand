
<?php 
$pageTitle = "Accueil | Second Hand";
include 'head.php';
include 'header.html';
require_once 'class/class.postings.php';
?>


    <?php 
    $select = new Posting();
    $select = $select->select();
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
    <?php endforeach ?>



<footer>
    <p> LE FOOTER </p>
</footer>

    
</body>
</html>