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
    <title>Inscription</title>
    <link rel="stylesheet" href="<?= CSS ?>style.css">
    <link rel="stylesheet" href="<?= CSS ?>header.css">
    <link rel="stylesheet" href="<?= CSS ?>inscription.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>

    <?php include TEMPLATE . '_header.php'   ?>

    <div>
        <h1> S'inscrire</h1>
    </div>
    <main>

        <script>
            alert("<?= $_SESSION['erreurEmailExistant'] ?>");
        </script>

        <form action="register.php" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom : </label>
                <input type="text" name="nom" class="form-control">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prenom : </label>
                <input type="text" name="prenom" class="form-control">
            </div>
            <div class="mb-3">
                <label for=email" class="form-label">Email : </label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"> Mot de passe :</label>
                <input type="password" name="password" class="form-control">
            </div>
            <input type="submit" value="Enregistrer" class="btn btn-primary">



        </form> <!-- avec un formulaire on use la methode post -->
    </main>



</body>

</html>