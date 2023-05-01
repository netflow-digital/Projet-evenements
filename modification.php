<?php

session_start();

//récupère l'identifiant de l'utilisateur
$user = $_SESSION['id_utilisateurs'];
//connexion à la base de donnée
try {
    include './config/connexionBdd.php';
} catch (Exception $e) {
    $e = 'Désolée la connexion à la base de donnée ne marche pas pour le moment';
    echo $e;
}

//récupère le nouveau mot de passe envoyé par un formulaire
$mdp = htmlspecialchars($_POST['mdp']);
$mdp = password_hash($mdp, PASSWORD_DEFAULT);

// Modification du mot de passe de l'utilisateur dans la base de données
$modificationMdp = $cnx->prepare("UPDATE utilisateurs SET password=:mdp WHERE id_utilisateurs=:id");
$modificationMdp->bindParam(':mdp', $mdp);
$modificationMdp->bindParam(':id', $user);
$modificationMdp->execute();

// Redirige l'utilisateur vers la page monCompte.php avec un message de confirmation
$message = "Le mot de passe de l'utilisateur a été modifié avec succès.";
header("Location: index.php?page=monCompte&message=" . urlencode($message));
exit();
