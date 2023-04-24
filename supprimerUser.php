<?php
include './config/config.php';
session_start();
//récupérer l'id de l'user en question
$id_utilisateurs = $_GET['id_utilisateurs'];
var_dump($id_utilisateurs);

//connexion à la bdd
try {
    $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
    $stmt = $cnx->prepare('DELETE FROM utilisateurs WHERE utilisateurs.id_utilisateurs=:id_utilisateurs');
    $stmt->bindParam(':id_utilisateurs', $id_utilisateurs);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

header('location:utilisateurs.php');
