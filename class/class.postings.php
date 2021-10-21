<?php

require_once 'class.database.php';


class Posting extends Database {

    public function select(){
        $postings = $this->connect()->prepare('SELECT * FROM `posting` WHERE 1');
        $postings-> execute();
        $post = $postings->fetchAll();
        return $post;
    }

}

?>