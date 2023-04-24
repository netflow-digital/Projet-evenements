<?php
include './config/config.php';
session_start();
//récupérer l'id de l'event
$id_events = $_GET['id_evenement'];

//connexion à la bdd
try {
    $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
    $stmt = $cnx->prepare('DELETE FROM evenements WHERE evenements.id_events=:id_events');
    $stmt->bindParam(':id_events', $id_events);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

header('location:accueil.php');
