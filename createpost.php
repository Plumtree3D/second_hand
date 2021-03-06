<?php 
session_start();
$pageTitle = "Ajouter une annonce";
include 'head.php';
include 'header.php';
require_once 'class/class.postings.php'; 
require_once 'class/class.pictures.php';
// var_dump($_FILES);
// echo "<br>";
// var_dump($_POST);
// echo "<br>";
// echo $upload_max_size = ini_get('upload_max_filesize');  
// echo $post_max_size=ini_get('post_max_size');

if($_SESSION["connecter"] != "yes"){
    header("location: login/login.php");
    exit();
}
?>



<!-- GENERAL FOR ALL CATEGORIES---------------  -->
<form method="post" enctype="multipart/form-data"> <!-- Formulaire -->

<div class="form">
    <div class="generalForm">
        <div class="createPostRow">
            <div>
                <label for="title"> Que voulez vous vendre ? </label> <br>
                <input type="text" placeholder="Nom de l'article" name="title" id="title">
            </div>

            <div>
                <label for="price"> À quel prix ? </label> <br>
                <span class="currencyinput"><input type="number" placeholder="Prix" step="0.01" name="price" class="innerValue"> €</span>
                
            </div>
        </div>


        <div class="imagesPreview"> <br>
            <label class="custom-file-upload"> Choississez une miniature </label> <br>
                <input type="file" name="file" id="">
        </div>

        <!--  -->

    <div class="createPostRow">
        <select name="catglobal" id="category" >
            <option value=""> Choisissez une catégorie </option>
            <option value="immobilier"> Immobilier </option>
            <option value="vehicule"> Véhicule </option>
            <option value="multimedia"> Multimédia </option>
        </select> <br>


        <div>
            <label for="loc"> Où le bien se trouve t'il ? </label> <br>
            <input type="text" placeholder="Localisation" name="loc"> <br>
        </div>
    </div>


        <label for="desc"> Une petite description? </label> <br> 
        <textarea placeholder="Description" name="desc"> </textarea> <br>

        <div class="imagesPreview"> <br>
            <label class="custom-file-upload"> Vous pouvez ajouter jusqu'à 9 images supplémentaires </label> <br>
                <input type="file"  multiple>
        </div>



    </div>

    <div class="sidebar">
        <!-- SPECIFIC FOR HOUSING---------------  -->

        <div id="housing" class="nodisplay">
            <label for="cat"> Maison ou appart? </label> <br>
            <select name="cat"> 
                <option value=""> Choisissez une catégorie </option>
                <option value="0"> Maison </option>
                <option value="1"> Appartement </option>
                <option value="2"> Autre </option>
            </select> 

            <br>
             <br>
            <div>
                <label for="surface"> Surface: </label>  <br>
                <span class="currencyinput"><input type="number" placeholder="Surface" step="0.1" name="surface" class="innerValue"> m²</span>
                
            </div>
            <br>

            <label for="rooms"> Nombre de pièces </label>  <br>
            <input type="number" placeholder="Nmbr de pièces" step="1" name="rooms"> <br>
        </div>
        <br>

        <!-- SPECIFIC FOR VEHICLE---------------  -->

        <div id="vehicle" class="nodisplay">
            <label for="brand"> La marque de votre véhicule: </label>  <br>
            <input type="text" placeholder="Mercedes" name="brand"> <br>

            <label for="model"> Son modèle: </label>  <br>
            <input type="text" placeholder="Mercedes" name="model"> <br>

            

            <div>
                <label for="mileage"> Son kilomètrage: </label>  <br>
                <span class="currencyinput"><input type="number" placeholder="100 000" step="1" name="mileage" class="innerValue"> Km</span>
                
            </div>

            <label for="fuel"> Carburant </label> <br>
            <select name="fuel">
                <option value=""> Choisissez une catégorie </option>
                <option value="0"> Essence </option>
                <option value="1"> Diesel </option>
                <option value="2"> Électrique </option>
            </select> <br>

            <label for="cat"> Sa boite de vitesse </label> <br>
            <select name="cat">
                <option value=""> Choisissez une catégorie </option>
                <option value="0"> Automatique </option>
                <option value="1"> Manuelle </option>
            </select> 
        </div>

        <!-- SPECIFIC FOR ELECTRONICS---------------  -->

            <select name="EUC" id="electronics" onChange="updateElec()" class="nodisplay">
                <option value=""> Choose an under category </option>
                <option value="0"> Informatique </option>
                <option value="1"> Consoles & Jeux vidéo </option>
                <option value="2"> Téléphonie </option>
            </select> <br>

            
        <div id="mobile" class="nodisplay">
            <label for="brand"> La marque de votre téléphone: </label>  
            <input type="text" placeholder="Samsung" name="brand"> <br>

            <label for="model"> Son modèle: </label>  
            <input type="text" placeholder="Galaxy S" name="model"> <br>

            <label for="stockage"> Sa capacité de stockage: </label>  
            <input type="number" placeholder="64" step="1" name="stockage"> Go <br>

            <select name="condition">
                <option value=""> Choose an under category </option>
                <option value="0"> État neuf </option>
                <option value="1"> Très bon état </option>
                <option value="2"> Bon état </option>
                <option value="1"> État satisfaisant </option>
                <option value="2"> Pour pièces </option>
            </select> <br>
        </div>

        <div id="computer" class="nodisplay">
            <label for="brand"> La marque de votre appareil: </label>  
            <input type="text" placeholder="Samsung" name="brand"> <br>

            <label for="model"> Son modèle: </label>  
            <input type="text" placeholder="Galaxy S" name="model"> <br>

            <select name="condition">
                <option value=""> Choose an under category </option>
                <option value="0"> État neuf </option>
                <option value="1"> Très bon état </option>
                <option value="2"> Bon état </option>
                <option value="1"> État satisfaisant </option>
                <option value="2"> Pour pièces </option>
            </select> <br>
        </div>

        <div class="validation">
            <div>
            <input type="submit" name="action" value="valider">
            </div>
        </div>

    </div>


    </form>
</div>

<!-- JAVASCRIPT POUR L'ENVOI DES DOCUMENTS -->


<script>
    function update() {
        let select = document.getElementById("category");
        let value = select.options[select.selectedIndex];
        if(value.value == 0) {
            document.getElementById("housing").classList.add("housing");
            document.getElementById("vehicle").classList.remove("housing");
            document.getElementById("electronics").classList.remove("housing");
        }
        else if (value.value == 1) {
            document.getElementById("vehicle").classList.add("housing");
            document.getElementById("housing").classList.remove("housing");
            document.getElementById("electronics").classList.remove("housing");
            }
        else if (value.value == 2) {
            document.getElementById("vehicle").classList.remove("housing");
            document.getElementById("housing").classList.remove("housing");
            document.getElementById("electronics").classList.add("housing");
        }

    }

    function selectorElec() {
        let select = document.getElementById("electronics");
        let value = select.options[select.selectedIndex];
        if(value.value == 0) {
            document.getElementById("housing").classList.add("housing");
            document.getElementById("vehicle").classList.remove("housing");
        }
        else if (value.value == 1) {
            document.getElementById("vehicle").classList.add("housing");
            document.getElementById("housing").classList.remove("housing");

            }

    }

    function updateElec() {
        let select = document.getElementById("category");
        let value = select.options[select.selectedIndex];
        if(value.value == 0) {
            document.getElementById("housing").classList.add("housing");
            document.getElementById("vehicle").classList.remove("housing");
            document.getElementById("electronics").classList.remove("housing");
        }
        else if (value.value == 1) {
            document.getElementById("vehicle").classList.add("housing");
            document.getElementById("housing").classList.remove("housing");
            document.getElementById("electronics").classList.remove("housing");
            }
        else if (value.value == 2) {
            document.getElementById("vehicle").classList.remove("housing");
            document.getElementById("housing").classList.remove("housing");
            document.getElementById("electronics").classList.add("housing");
        }

    }





</script>





<!-- ENVOI ET STOCKAGE DES IMAGES  -->

<?php 
if(isset($_FILES['file'])) {  //On récupère toutes les données du fichier et les stocke dans des variables

    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $maxSize = 8388608;

    $tabExtension = explode('.', $name); //On compare l'extension du fichier aux extension acceptées (jpg ou png)
    $extension = strtolower(end($tabExtension));

    $extensions = ['jpg','jpeg','png'];

    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0) { //On viérifie que l'extension soit bonne, que la taille respecte la limite et qu'il n'y ait pas d'erreur

        $autoname = uniqid('img', false); //On donne un nom unique à l'image pour éviter que deux images aux noms identiques s'écrasent
        $file = $autoname.'.'.$extension;
        move_uploaded_file($tmpName, './user_images/'.$file);







    } else {
        echo "L'image ne convient pas! <br> erreur: $error";
    }


}

if(isset($_POST['action']) && $_POST['action']=="valider") {
    $create = new Posting();
    $create->create();
    

    header('Location: index.php'); }

?>



<?php include 'footer.html' ?>
</body>
</html>