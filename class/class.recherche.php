<?php

require_once 'class.database.php';

class Search extends Database {

    private $search;

    public function recherche($search){

    $search = $_POST["rechercher"];

    }
}


?>