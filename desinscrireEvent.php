<?php
include './config/config.php';
session_start();
//récupérer l'ID de l'utilisateurs
$id_utilisateurs = $_SESSION['id_utilisateurs'];

// Récupérer l'ID de l'événement à partir de la requête GET
$id_events = $_GET['id_evenement'];

// se désinscire de l'event
try {
    $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
    $stmt = $cnx->prepare('DELETE FROM `inscrire` WHERE `inscrire`.`id_utilisateurs` = :id_utilisateurs AND `inscrire`.`id_events` = :id_events');
    $stmt->bindParam(':id_utilisateurs', $id_utilisateurs);
    $stmt->bindParam(':id_events', $id_events);
    $stmt->execute();

    // Rediriger l'utilisateur vers la page de l'événement avec un message de confirmation
    header("Location: accueil.php?id_events=$id_events");
    exit();
} catch (PDOException $e) {
    // Affichage d'un message d'erreur si la connexion à la base de données a échoué
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
