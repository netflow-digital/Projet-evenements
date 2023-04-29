<?php
include './config/config.php';
session_start();
//récupérer l'id de l'user en question
$id_utilisateurs = $_GET['id_utilisateurs'];

//connexion à la bdd
try {
    include './config/connexionBdd.php';
    $stmt = $cnx->prepare('DELETE FROM utilisateurs WHERE utilisateurs.id_utilisateurs=:id_utilisateurs');
    $stmt->bindParam(':id_utilisateurs', $id_utilisateurs);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

header('location:utilisateurs.php');
