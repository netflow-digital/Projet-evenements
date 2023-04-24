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
    <title>Document</title>
    <link rel="stylesheet" href="<?= CSS ?>style.css">
    <link rel="stylesheet" href="<?= CSS ?>header.css">
    <link rel="stylesheet" href="<?= CSS ?>creationEvent.css">
</head>

<body>
    <?php include TEMPLATE . '/_header.php';
    ?>
    <main id="container">
        <section class="section1">
            <h1> Créer un nouvel événement</h1>

        </section>

        <section class="section2">
            <div class="container">
                <form id="form" action="./creationEvenement.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="titre">Titre </label><br>
                        <input type="text" name="titre" id="titre" required>
                    </div>
                    <div>
                        <label for="description"> Description de l'événement </label><br>
                        <textarea name="description" id="description" rows="20" placeholder="    Votre description" required></textarea>
                    </div>
                    <div>
                        <label for="date"> Date de l'événement </label><br>
                        <input type="datetime-local" name="date" id="date" required>
                    </div>
                    <div>
                        <label for="nbPersonnesMax"> Nombre de personnes maximun pour l'événement: </label><br>
                        <input type="int" name="nbPersonnesMax" id="nbPersonnesMax" required>
                    </div>
                    <div>
                        <p><label for="imageSrc"> Upload une image (format jpeg, jpg et png) </label></p><br>
                        <input type="file" name="imageSrc" id="imageSrc" required>

                    </div>
                    <div>
                        <p><label for="organisateur">Organisateur de l'événement :</label></p><br>
                        <select id="organisateur" name="organisateur" required>
                            <option value="">-- Sélectionnez un organisateur --</option>
                            <?php
                            // Connexion à la base de données
                            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);

                            // Requête SQL pour récupérer les ID et noms des utilisateurs ayant pour rôle "organisateur"
                            $query = "SELECT id_utilisateurs, nom FROM utilisateurs WHERE role='organisateur'";
                            $result = $pdo->query($query);

                            // Création des options du select
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id_utilisateurs'] . "'>" . $row['nom'] . "</option>";
                            }
                            ?>
                        </select>
                        <br>

                    </div>
                    <div>
                        <br>
                        <p><label for="id_lieux"> Lieu de l'événement</label></p><br>
                        <select name="id_lieux" id="id_lieux" required>
                            <option value="">-- Sélectionnez le lieu --</option>

                            <?php
                            //connection bdd
                            $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
                            // Requête SQL pour récupérer les lieux potentiel pour les événements"
                            $reponse = 'SELECT * FROM lieux';
                            $resultat = $cnx->query($reponse);

                            // Création des options du select
                            while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $donnees['id_lieux'] . "'>" . $donnees['nom'] . " " . $donnees['adresse'] . " " . $donnees['codePostal'] . " " . $donnees['ville'] . "</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="button">
                        <input type="submit" id="buttonSubmit" value="valider la création">
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>