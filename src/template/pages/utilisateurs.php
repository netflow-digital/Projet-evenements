<?php
//connexion à la bdd
try {
    include DB_CONFIG;
    $stmt = $cnx->prepare("SELECT * FROM utilisateurs");
    $stmt->execute();
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
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