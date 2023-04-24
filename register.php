<?php
include './config/config.php';
session_start();


//vérifier les données de $_POST

//// on vérifie que les champs ne sont pas vides
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password'])) {
    if ($_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['email'] != '' && $_POST['password'] != '') {
        // Protection des champs de formulaires contre l'injection de javascript
        $nom = htmlspecialchars($_POST['nom']); // modif les caractères dans $nom d'une certaine façon, encode.
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encoder les mot de passe
        $role = 'user';
    } else {
        header('location:inscription.php');
    }
}
//// connexion à la base de donnée
try {
    $cnx = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);
    ///vérifier qu'il n'y a pas déja un utilisateur avec cet email
    $stmtEmail = $cnx->prepare('SELECT * FROM utilisateurs WHERE email=:email');
    $stmtEmail->bindParam(':email', $email);
    $stmtEmail->execute();
    $userExistant = $stmtEmail->fetch(PDO::FETCH_ASSOC);
    if ($userExistant) {
        $_SESSION['erreurEmailExistant'] = "Un compte avec cet email existe déjà ";
        header('location:inscription.php');
    }


    // enregistrer les données dans la base de donnée
    ////faire la requête SQL
    $stmt = $cnx->prepare("INSERT INTO utilisateurs(id_utilisateurs, nom, prenom, email, password,role) VALUES(NULL, :nom, :prenom, :email, :password, :role)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->execute();
    header('location:accueil.php');
} catch (PDOException $e) {
    // Affichage d'un message d'erreur si la connexion à la base de données a échoué
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
