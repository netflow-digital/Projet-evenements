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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= CSS ?>/style.css">
    <link rel="stylesheet" href="<?= CSS  ?>/header.css">
    <link rel="stylesheet" href="<?= CSS  ?>/responsive.css">
    <?php if (!empty($_GET['page'])) : ?>
        <link rel="stylesheet" href="<?= CSS  ?><?= $_GET['page'] ?>.css">
    <?php else : ?>
        <link rel="stylesheet" href="<?= CSS  ?>accueil.css">
    <?php endif ?>
    <?php if (!empty($_GET['page'])) : ?>
        <script defer src="<?= JS ?><?= $_GET['page'] ?>.js"></script>
    <?php endif ?>

</head>
<?php include TEMPLATE . '_header.php'; ?>

<body>
    <main id="container">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == "accueil") {
                include PAGES . 'accueil.php';
            } elseif ($page == "connexion") {
                include PAGES . 'connexion.php';
            } elseif ($page == "contact") {
                include PAGES . 'contact.php';
            } elseif ($page == "creationEvent") {
                include PAGES . 'creationEvent.php';
            } elseif ($page == "evenements") {
                include PAGES . 'evenements.php';
            } elseif ($page == "filtrage") {
                include PAGES . 'filtrage.php';
            } elseif ($page == "inscription") {
                include PAGES . 'inscription.php';
            } elseif ($page == "listeEvents") {
                include PAGES . 'listeEvents.php';
            } elseif ($page == "monCompte") {
                include PAGES . 'monCompte.php';
            } elseif ($page == "utilisateurs") {
                include PAGES . 'utilisateurs.php';
            } else {
                include PAGES . "page404.php";
            }
        } else {
            include PAGES . 'accueil.php';
        }
        ?>

    </main>
</body>

</html>