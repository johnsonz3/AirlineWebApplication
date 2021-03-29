<?php
try {
    $connection = new PDO('mysql:host=localhost;dbname=airlineDB', "root", "");
} catch (PDOException $e){
    print "Error!: ". $e->getMessage(). "<br/>";
    die();
}
?>