<?php 
require_once 'class/class.postings.php';
$select = new Posting();
$select = $select->postingPage();
foreach($select as $truc);
$pageTitle = $truc['posting_title'];


include 'head.php';
include 'header.php';


?>
<p> <strong> <?php echo $truc['posting_title']; ?> </strong> <span><?php echo $truc['posting_price']; ?> € </span>  </p> 


<div class="placeholder">
<?php 
if(!is_null($truc['picture_name'])) {
echo '<img src="user_images/'.$truc['picture_name'].'">'; } 
?>
 </div>
                  
<p> <img src="images/user-alt.svg" alt=""> <strong>  <?php echo $truc['user_name']; ?> </strong>  </p>
<br> 
                <span> <img src="images/map_marker.svg" alt=""> <?php echo $truc['posting_loc']; ?> </span> <br>


                     <?php echo $truc['posting_desc']; ?> 
                     <br>
                     
               <span> Postée le <?php echo $truc['posting_date']; ?> </span>


               







<?php include 'footer.html'; ?>


</body>

</html>