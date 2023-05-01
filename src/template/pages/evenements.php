<?php
$id = $_GET["id"];

try {
    // connexion à la bdd
    include DB_CONFIG;
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