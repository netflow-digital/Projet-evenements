<?php
// Vérifier si l'utilisateur est connecté
session_start();
include './config/config.php';
//récupérer l'ID de l'utilisateurs
$id_utilisateurs = $_SESSION['id_utilisateurs'];

// Récupérer l'ID de l'événement à partir de la requête GET
$id_events = $_GET['id_evenement'];


// Inscrire l'utilisateur à l'événement dans la base de données
try {
    $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
    $stmt = $cnx->prepare('INSERT INTO inscrire(id_utilisateurs, id_events) VALUES (:id_utilisateurs, :id_events)');
    $stmt->bindParam(':id_utilisateurs', $id_utilisateurs);
    $stmt->bindParam(':id_events', $id_events);
    $stmt->execute();

    // Rediriger l'utilisateur vers la page de l'événement avec un message de confirmation
    header("Location: accueil.php?id_events=$id_events");
    exit();
} catch (PDOException $e) {
    // Afficher une erreur si l'insertion dans la base de données a échoué
    die("Erreur : " . $e->getMessage());
}

/*Dans ce code, nous récupérons l'id du user, puis nous récupérons l'ID de l'événement à partir de la requête GET. Ensuite, nous insérons l'inscription de l'utilisateur dans la base de données en utilisant une requête préparée pour sécuriser les entrées de l'utilisateur. Si l'insertion est réussie, nous redirigeons l'utilisateur vers la page de l'événement avec un message de confirmation. Si l'insertion échoue, nous affichons une erreur.*/