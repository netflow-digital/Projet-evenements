<h1> Vos événements</h1>
<section>
    <?php
    try {
        // Connexion à la base de données evenements
        $user = $_SESSION['id_utilisateurs'];
        include './config/connexionBdd.php';

        // Requête SQL pour récupérer les événements auxquels l'utilisateur est inscrit
        $stmt = $cnx->prepare("SELECT * FROM `listeUtilisateurInscritAEvent` WHERE id_utilisateurs=:user");
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Boucle pour afficher les événements récupérés
        foreach ($evenements as $evt) : ?>
            <div class="vignette">
                <div><img src="<?= IMAGES ?><?= $evt['imageSrc'] ?>"></img></div>
                <div class="descriptif">
                    <div class="disposition">
                        <h2><?= $evt['titre'] ?></h2>
                        <p>Date: <?= $evt['date'] ?></p>
                    </div>

                    <div class="disposition">
                        <button><a href="index.php?page=evenements&id= <?= $evt['id_events'] ?>"> Voir les détails</a></button>
                        <p>Nombre de places : <?= $evt['nbPersonnesMax'] ?></p>
                    </div>
                </div>
            </div>
    <?php endforeach;
    } catch (PDOException $e) {
        // Affichage d'un message d'erreur si la connexion à la base de données a échoué
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    ?>
</section>