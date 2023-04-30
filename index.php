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
    <link rel="stylesheet" href="<?= CSS ?>/style.css">
    <link rel="stylesheet" href="<?= CSS  ?>/header.css">
    <link rel="stylesheet" href="<?= CSS  ?>/responsive.css">
    <?php if (!empty($_GET['page'])) : ?>
        <link rel="stylesheet" href="<?= CSS  ?>/<?= $_GET['page'] ?>.css">
    <?php else : ?>
        <link rel="stylesheet" href="<?= CSS  ?>/accueil.css">
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