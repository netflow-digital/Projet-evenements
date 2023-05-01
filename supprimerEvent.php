<?php
include './src/config/config.php';
session_start();
//récupérer l'id de l'event
$id_events = $_GET['id_evenement'];

//connexion à la bdd
try {
    include DB_CONFIG;
    $stmt = $cnx->prepare('DELETE FROM evenements WHERE evenements.id_events=:id_events');
    $stmt->bindParam(':id_events', $id_events);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

header('location:index.php?page=accueil');
