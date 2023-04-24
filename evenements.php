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
    <link rel="stylesheet" href="<?= CSS ?>evenements.css">
    <link rel="stylesheet" href="<?= CSS ?>responsive.css">
</head>

<body>
    <?php include TEMPLATE . '_header.php' ?>
    <main>
        <?php
        $id = $_GET["id"];

        try {
            // connexion à la bdd
            $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
            //requête préparée avec un paramètre => id=?
            $stmt = $cnx->prepare("SELECT * FROM liste_events WHERE id_events=?");
            $stmt->execute([$id]); //méthode execute() attend un tableau de valeurs en paramètre correspondant aux paramètres de la requête SQL
            $evenements = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($evenements)) : ?>
                <p> Pas d'évenement correspondant à cet id</p>
            <?php else : ?>
                <div id="container">
                    <h1><?= $evenements["titre"] ?></h1>
                    <section class="section1">
                        <ul>
                            <li><?= $evenements["date"] ?></li>
                            <li><?= $evenements["lieux"] ?></li>
                            <li><?= $evenements["nbPersonnesMax"] ?> places</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </section>
                    <div class="image">
                        <img src="<?= IMAGES ?><?= $evenements["imageSrc"] ?>" alt="">
                    </div>
                    <p class="description"><?= $evenements["description"] ?></p>
                </div>
                <?php
                if (isset($_SESSION['role_utilisateurs']) && $_SESSION['role_utilisateurs'] == 'admin') :
                    $admin = $cnx->prepare("SELECT id_utilisateurs, nomUtilisateur, prenom FROM `listeUtilisateurInscritAEvent` WHERE id_events=?");
                    $admin->execute([$id]);
                    $listeUser = $admin->fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <div>
                        <p> Personnes inscrites à cet événement : </p><br>
                        <?php foreach ($listeUser as $user) : ?>
                            <p><?= " Utilisateur id : {$user['id_utilisateurs']} ,   {$user['nomUtilisateur']}  {$user['prenom']} " ?></p><br>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <br>
            <?php endif ?>
        <?php
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
        ?>

    </main>
</body>

</html>