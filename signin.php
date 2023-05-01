<?php
include './src/config/config.php';
// permet d'utiliser des sessions ($_SESSION)
session_start();

//connexion BDD
try {
    include './src/config/connexionBdd.php';
    //vérifier s'il existe un utilisateur dans la bdd avec cet email
    $stmt = $cnx->prepare("SELECT * FROM `utilisateurs` WHERE email=:email");
    $email = htmlspecialchars($_POST['email']);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC); // fetch renvoie false si l'email n'est pas dans la bdd

    //vérifier le mot de passe
    if ($utilisateur) {  //équivalent à if($utilisateur != false)
        $mdp = $_POST['password'];
        if (password_verify($mdp, $utilisateur['password'])) {
            $_SESSION['id_utilisateurs'] = $utilisateur['id_utilisateurs'];
            $_SESSION['nom_utilisateurs'] = $utilisateur['nom'];
            $_SESSION['prenom_utilisateurs'] = $utilisateur['prenom'];
            $_SESSION['role_utilisateurs'] = $utilisateur['role'];
            header('location:index.php?page=accueil');
        } else {
            header('location:index.php?page=connexion');
        }
    } else {
        //mettre l'utilisateur en session
        header('location:index.php?page=connexion');
    }
} catch (PDOException $e) {
    // Affichage d'un message d'erreur si la connexion à la base de données a échoué
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
