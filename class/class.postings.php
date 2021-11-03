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
        $add->bindParam(':cat', $_POST['catglobal']);
        $add->bindParam(':desc', $_POST['desc']);
        $add->bindParam(':loc', $_POST['loc']);
        $add->bindParam(':id',$_SESSION['user_id']);
        $add->execute();
        $add->debugDumpParams(); 

        var_dump($add->errorInfo());
        
    }


    public function userPostings() {
        $userid = $_SESSION['user_id'];
        $postings = $this->connect()->prepare('SELECT posting.posting_id, posting_date, posting_title, posting_cat, posting_desc, posting_price, posting_loc, user_name, user_profilepicture, user_email, picture_id, picture_name FROM `posting` INNER JOIN user ON posting.user_id = user.user_id LEFT JOIN picture ON posting.posting_id = picture.posting_id WHERE user.user_id = (:id) ORDER BY posting.posting_id DESC');
        $postings->bindParam(':id',$_SESSION['user_id']);
        $postings-> execute();
        $post = $postings->fetchAll();
        return $post;
    }

    public function postingPage() {
        $postings = $this->connect()->prepare('SELECT * FROM `posting` INNER JOIN user ON posting.user_id = user.user_id LEFT JOIN picture ON posting.posting_id = picture.posting_id WHERE posting.posting_id = (:id)');
        $postings->bindParam(':id',$_GET['post']);
        $postings-> execute();
        $post = $postings->fetchAll();
        return $post;

    }

    // Fonction pour la barre de recherche et les catégories

    public function search(){

        $postings = $this->connect()->prepare('SELECT * FROM posting INNER JOIN user ON posting.user_id = user.user_id WHERE posting.posting_title LIKE :search OR posting.posting_desc LIKE :search ORDER BY posting.posting_id DESC;');
        $postings->bindValue(':search', '%'.$_GET['search'].'%', PDO::PARAM_STR);
        $postings-> execute();
        $post = $postings->fetchAll();
        return $post;
    } 

    public function localisation(){
        $loca = $this->connect()->prepare('SELECT * FROM posting INNER JOIN user ON posting.user_id = user.user_id WHERE posting.posting_loc LIKE :localisation ORDER BY posting.posting_id DESC;');
        $loca->bindValue(':localisation', '%'.$_GET['localisation'].'%', PDO::PARAM_STR);
        $loca->execute();
        $loc = $loca->fetchAll();
        return $loc;
    }

    public function catImmo(){
        $cat = $this->connect()->prepare("SELECT * FROM posting WHERE posting_cat = 'immobilier' ");
        $cat->execute();
        $categorie = $cat->fetchAll();
        return $categorie;
    }

    public function catVehicle(){
        $cat = $this->connect()->prepare("SELECT * FROM posting WHERE posting_cat = 'véhicule' ");
        $cat->execute();
        $categorie = $cat->fetchAll();
        return $categorie;
    }

    public function catMedia(){
        $cat = $this->connect()->prepare("SELECT * FROM posting WHERE posting_cat = 'multimédia' ");
        $cat->execute();
        $categorie = $cat->fetchAll();
        return $categorie;
    }

    // Fonctions pour date et prix par odre croissant ou décroissant

    public function orderDateC(){
        $orderd = $this->connect()->prepare("SELECT * FROM posting  ORDER BY posting_date ASC");
        $orderd-> execute();
        $date_order = $orderd->fetchAll(); 
        return $date_order;
    }

    public function orderDateD(){
        $orderd = $this->connect()->prepare("SELECT * FROM posting  ORDER BY posting_date DESC");
        $orderd-> execute();
        $date_order = $orderd->fetchAll(); 
        return $date_order;
    }

    public function orderPriceC(){
        $orderp = $this->connect()->prepare("SELECT * FROM `posting` ORDER BY posting_price ASC");
        $orderp-> execute();
        $price_order = $orderp->fetchAll(); 
        return $price_order;
    }

    public function orderPriceD(){
        $orderp = $this->connect()->prepare("SELECT * FROM `posting` ORDER BY posting_price DESC");
        $orderp-> execute();
        $price_order = $orderp->fetchAll(); 
        return $price_order;
    }

}

?>