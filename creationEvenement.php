<?php
include './config/config.php';
session_start();
$formError = [];

//vérifier les données de $_POST envoyé par formCreationEvenement.php
if (isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['nbPersonnesMax']) && isset($_FILES['imageSrc']) && isset($_POST['organisateur']) && isset($_POST['id_lieux'])) {
    var_dump('premier if');
    //// on vérifie que les champs ne sont pas vides
    if ($_POST['titre'] != '' && $_POST['description'] != '' && $_POST['date'] != '' && $_POST['nbPersonnesMax'] != '' && $_FILES['imageSrc'] != '' && $_POST['organisateur'] != '' && $_POST['id_lieux'] != '') {
        // Protection des champs de formulaires contre l'injection de javascript
        var_dump('deuxième if');
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $date = htmlspecialchars($_POST['date']);
        $nbPersonnesMax = htmlspecialchars($_POST['nbPersonnesMax']);
        $id_utilisateurs = htmlspecialchars($_POST['organisateur']);
        $id_lieux = htmlspecialchars($_POST['id_lieux']);
    } else {
        header('location:formCreationEvenement.php');
        var_dump('je suis dans le else');
    }
}


//connexion à la base de donnée
try {
    $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
    //vérifier qu'il n'y a pas d'événemenet avec le même nom, le même jour
    $stmtTitleDate = $cnx->prepare('SELECT * FROM evenements WHERE evenements.titre=:titre AND evenements.date=:date');
    $stmtTitleDate->bindParam(':titre', $titre);
    $stmtTitleDate->bindParam(':date', $date);
    $stmtTitleDate->execute();
    $eventExistant = $stmtTitleDate->fetch(PDO::FETCH_ASSOC);
    if ($eventExistant) {
        $_SESSION['erreurEventExistant'] = "Un événement à déja lieu le même jour ";
        header('location:formCreationEvenement.php');
    }
    var_dump("étape 1");
    //vérifier le format de l'image
    if ($_FILES["imageSrc"]["size"] > 0) {
        // vérification du type de fichier
        $types = ["image/jpeg", "image/png"];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeFichier = finfo_file($finfo, $_FILES["imageSrc"]["tmp_name"]);
        if (!in_array($mimeFichier, $types)) {
            $formError[] = "Type de fichier non autorisé";
        }
        $maxSize = 5 * 1024 * 1024;
        if ($_FILES["imageSrc"]["size"] > $maxSize) {
            $formError[] = "La taille du fichier est trop grande";
        }
        if (empty($formError)) {
            var_dump("erreur");
            //Génération de noms uniques : pour ne pas avoir plusieurs noms de fichiers identiques
            //uniqid() crée un id unique haché
            $imageSrc = uniqid() . " " . $_FILES["imageSrc"]["name"];
            move_uploaded_file($_FILES["imageSrc"]["tmp_name"], IMAGES . $imageSrc);
        }
    } else {
        $formError[] = "Le fichier ne peut pas être vide";
    }

    // enregistrer les données dans la base de donnée
    ////faire la requête SQL
    $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
    $stmt = $cnx->prepare("INSERT INTO evenements(id_events, titre, description, date, nbPersonnesMax, imageSrc,id_utilisateurs, id_lieux) VALUES(NULL, :titre, :description, :date, :nbPersonnesMax, :imageSrc, :id_utilisateurs, :id_lieux) ");
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':nbPersonnesMax', $nbPersonnesMax);
    $stmt->bindParam(':imageSrc', $imageSrc);
    $stmt->bindParam(':id_utilisateurs', $id_utilisateurs);
    $stmt->bindParam(':id_lieux', $id_lieux);
    $stmt->execute();
    header('location:accueil.php');
} catch (PDOException $e) {
    // Affichage d'un message d'erreur si la connexion à la base de données a échoué
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
