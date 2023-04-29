<?php

include './config/config.php';
session_start();
//connexion à la bdd
try {
    include './config/connexionBdd.php';
    $stmt = $cnx->prepare("SELECT * FROM utilisateurs");
    $stmt->execute();
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
    <link rel="stylesheet" href="<?= CSS ?>/style.css">
    <link rel="stylesheet" href="<?= CSS  ?>/header.css">
    <link rel="stylesheet" href="<?= CSS  ?>/utilisateurs.css">
</head>

<body>
    <?php include TEMPLATE . '_header.php'; ?>
    <main id="container">
        <section class="fiche">
            <h1> Ensemble des utilisateurs inscrit sur le site</h1>
            <?php foreach ($utilisateurs as $user) : ?>
                <div class="ficheUser">
                    <br>
                    <p> Identifiant utilisateur : <?= $user['id_utilisateurs']; ?> </p>
                    <p> Nom prénom : <?= $user['nom'] . " " . $user['prenom']; ?> </p>
                    <p> Email : <?= $user['email']; ?> </p>
                    <p> Role : <?= $user['role']; ?> </p>
                    <br>
                    <div> <button type=input><a href="supprimerUser.php?id_utilisateurs=<?= $user['id_utilisateurs']; ?>">Supprimer </a></button></div>
                </div>
            <?php endforeach ?>

        </section>

</body>

</html>