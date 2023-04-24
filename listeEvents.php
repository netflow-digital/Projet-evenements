<?php
include './config/config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes événements</title>
    <link rel="stylesheet" href="<?= CSS ?>style.css">
    <link rel="stylesheet" href="<?= CSS ?>header.css">
    <link rel="stylesheet" href="<?= CSS ?>responsive.css">
</head>

<body>
    <?php include TEMPLATE . '_header.php'; ?>

    <main id="container">
        <h1> Vos événements</h1>
        <section>
            <?php
            try {
                // Connexion à la base de données evenements
                $user = $_SESSION['id_utilisateurs'];
                $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);

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
                                <button><a href="evenements.php?id= <?= $evt['id_events'] ?>"> Voir les détails</a></button>
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
    </main>
</body>

</html>