<?php

function sanitize($data){
    return htmlentities(strip_tags(stripslashes(trim($data))));
}

function connect(){
    $bdd = new PDO('mysql:host=localhost;dbname=randochien','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    return $bdd;
}
?>