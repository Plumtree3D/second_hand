<?php

require_once 'class.database.php';



class Posting extends Database {

    public function select(){
        $postings = $this->connect()->prepare('SELECT * FROM `posting` INNER JOIN user ON posting.user_id = user.user_id ORDER BY posting.posting_id DESC');
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

    public function search(){

        $postings = $this->connect()->prepare('SELECT * FROM posting INNER JOIN user ON posting.user_id = user.user_id WHERE posting.posting_title LIKE :search OR posting.posting_desc LIKE :search ORDER BY posting.posting_id DESC;');
        $postings->bindValue(':search', '%'.$_GET['search'].'%', PDO::PARAM_STR);
        $postings-> execute();
        $post = $postings->fetchAll();
        return $post;
    } 

    public function orderDate(){
        $orderd = $this->connect()->prepare("SELECT * FROM `posting` ORDER BY posting_date ASC");
        $orderd-> execute();
        $price_order = $orderd->fetchAll(); 
        return $price_order;
    }

    public function orderPrice(){
        $orderp = $this->connect()->prepare("SELECT * FROM `posting` ORDER BY posting_price ASC");
        $orderp-> execute();
        $price_order = $orderp->fetchAll(); 
        return $price_order;
    }

}


?>