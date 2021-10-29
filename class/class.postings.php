<?php

require_once 'class.database.php';



class Posting extends Database {

    public function select(){
        $postings = $this->connect()->prepare('SELECT posting.posting_id, posting_date, posting_title, posting_cat, posting_desc, posting_price, posting_loc, user_name, user_profilepicture, user_email, picture_id, picture_name FROM `posting` INNER JOIN user ON posting.user_id = user.user_id LEFT JOIN picture ON posting.posting_id = picture.posting_id ORDER BY posting.posting_id DESC');
        $postings-> execute();
        $post = $postings->fetchAll();
        return $post;
    }


    public function create(){
        $date = date('Y-m-d');

        $add = $this->connect()->prepare("INSERT INTO posting (posting_date, posting_title, posting_cat, posting_desc, posting_price, posting_loc, user_id) VALUES (:date, :title, :cat, :desc, :price, :loc, :id)");
        $add->bindParam(':date', $date );
        $add->bindParam(':title', $_POST['title']);
        $add->bindParam(':price', $_POST['price']);
        $add->bindParam(':cat', $_POST['cat']);
        $add->bindParam(':desc', $_POST['desc']);
        $add->bindParam(':loc', $_POST['loc']);
        $add->bindParam(':id',$_SESSION['user_id']);
        $add->execute();

        var_dump($add->errorInfo());
        
    }

    public function userPostings() {
        $userid = $_SESSION['user_id'];
        $postings = $this->connect()->prepare('SELECT * FROM `posting` INNER JOIN user ON posting.user_id = user.user_id LEFT JOIN picture ON posting.posting_id = picture.posting_id WHERE user.user_id = (:id) ORDER BY posting.posting_id DESC');
        $postings->bindParam(':id',$_SESSION['user_id']);
        $postings-> execute();
        $post = $postings->fetchAll();
        return $post;


    }





}


?>