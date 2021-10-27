<?php

require_once 'class.database.php';



class Posting extends Database {

    public function select(){
        $postings = $this->connect()->prepare('SELECT * FROM `posting` INNER JOIN user ON posting.user_id = user.user_id LEFT JOIN picture ON posting.posting_id = picture.posting_id ORDER BY posting.posting_id DESC');
        $postings-> execute();
        $post = $postings->fetchAll();
        return $post;
    }


    public function create(){
        $add = $this->connect()->prepare("INSERT INTO posting (posting_title, posting_cat, posting_desc, posting_price, posting_loc, user_id) VALUES (:title, :cat, :desc, :price, :loc, :id)");
        $add->bindParam(':title', $_POST['title']);
        $add->bindParam(':price', $_POST['price']);
        $add->bindParam(':cat', $_POST['cat']);
        $add->bindParam(':desc', $_POST['desc']);
        $add->bindParam(':loc', $_POST['loc']);
        $add->bindParam(':id',$_POST['id']);
        $add->execute();
        
    }




}


?>