<?php

session_start();
include './config/config.php';
// Récupérer l'ID de l'événement à partir de la requête GET
$id_events = $_GET['id_evenement'];
var_dump($id_events);
//Récupérer l'ID du nombres de Place à partir de la requête GET
$nbPersonnesMax = $_GET['nbPersonnesMax'];
var_dump($nbPersonnesMax);

//requête sql pour modifier le nombre de personnes
try {
    $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
    $downgrade = $cnx->prepare('UPDATE evenements SET nbPersonnesMax=:nbPersonnesMax -1 WHERE evenements.id_events=:id_events');
    $downgrade->bindParam(':nbPersonnesMax', $nbPersonnesMax);
    $downgrade->bindParam(':id_events', $id_events);
    $downgrade->execute();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

header('location:accueil.php');
