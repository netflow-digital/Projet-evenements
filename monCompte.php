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
    <title>Mon compte</title>
    <link rel="stylesheet" href="<?= CSS ?>header.css">
    <link rel="stylesheet" href="<?= CSS ?>style.css">
    <link rel="stylesheet" href="<?= CSS ?>changeMdp.css">
    <link rel="stylesheet" href="<?= CSS ?>responsive.css">
    <script defer src="<?= JS ?>changeMdp.js"></script>

</head>

<body>
    <?php include TEMPLATE . '_header.php';
    ?>
    <main id="container">
        <div>
            <?php
            // Vérifie si un message est défini dans l'URL
            if (isset($_GET['message'])) {
                // Affiche le message
                echo ($_GET['message']);
            }
            ?>
        </div>

        <h1> Mon compte</h1>
        <p> Mes informations </p>
        <?php
        //indentification de l'utilisateur
        $userConnect = $_SESSION['id_utilisateurs'];
        // Connexion à la base de donnée
        try {
            $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
            $stmt = $cnx->prepare("SELECT nom, prenom FROM `utilisateurs` WHERE id_utilisateurs=:userConnect ");
            $stmt->bindParam(':userConnect', $userConnect);
            $stmt->execute();
            $utilisateurCompte = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($utilisateurCompte as $user) : ?>
                <p> <?= $user['nom'] . " " . $user['prenom'] ?></p>
        <?php endforeach;
        } catch (PDOException $e) {
            // Affichage d'un message d'erreur si la connexion à la base de données a échoué
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
        ?>

        <h2> Modifier mon mot de passe</h2>
        <p> Votre mot de passe doit contenir au moins 8caractères, une lettre Majuscule, minuscule, un chiffre et au moins un caractère spéciale</p>
        <form id="form" action="modification.php" method="post">
            <label for="">Nouveau mot de passe</label><br>
            <input type="text" name="mdp" id="mdp" required>
            <br>
            <label for="">Repéter votre nouveau mot de passe</label><br>
            <input type="text" name="md2" id="mdp2" required><br>
            <input type="submit" id="buttonSubmit" value="Mettre à jour" disabled>
        </form>


    </main>
</body>

</html>