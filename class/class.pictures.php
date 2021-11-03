<?php

require_once 'class.database.php';



class Picture extends Database {

    public function addPicture(){
        $cheval = "cheval";
        $add = $this->connect()->prepare("INSERT INTO `picture` `picture_name`, `posting_id` VALUES (':name',':id')");
        $add->bindParam(':name', $cheval);
        $add->bindParam(':id',$_POST['id']);
        $add->execute();
    }

}


?>