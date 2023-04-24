<script src="https://kit.fontawesome.com/705902a3b9.js" crossorigin="anonymous"></script>

<header>
    <div class="contenant">
        <ul>
            <li><a href="./accueil.php">Evénements</a></li>
            <li><a href="./form.php">Nous contactez</a></li>
            <li><a href="">A propos</a></li>
            <li><i class="fa-solid fa-user fa-2x" id="menu-icon"></i></li>

        </ul>
    </div>

    <nav id="menuConnexion">
        <ul>
            <li><?php if (!isset($_SESSION["id_utilisateurs"])) : ?><a href="connexion.php">Se connecter</a><?php endif ?></li>
            <li> <?php if (isset($_SESSION["id_utilisateurs"])) : ?><a href="deconnexion.php">Se déconnecter</a><?php endif ?></li>
            <li><?php if (isset($_SESSION["id_utilisateurs"])) : ?><a href="monCompte.php">Mon compte</a><?php endif ?></li>
            <li><?php if (isset($_SESSION["id_utilisateurs"])) : ?><a href="./listeEvents.php">Mes événements</a><?php endif ?></li>
            <li><?php if (isset($_SESSION['role_utilisateurs']) && $_SESSION['role_utilisateurs'] == 'admin') : ?><a href="formCreationEvenement.php"> Créer un événement </a><?php endif ?> </li>
            <li><?php if (isset($_SESSION['role_utilisateurs']) && $_SESSION['role_utilisateurs'] == 'admin') : ?><a href="utilisateurs.php"> Liste des utilisateurs </a><?php endif ?> </li>
            <!-- chemin relatif donc accès direct pour le chemin -->
        </ul>
    </nav>

    <script>
        // Sélectionner l'icône du menu et le menu défilant
        const menuIcon = document.querySelector('#menu-icon');
        const menu = document.querySelector('#menuConnexion');
        const deconnexion = document.querySelector('#deconnexion');

        // Ajouter un événement de clic à l'icône du menu
        menuIcon.addEventListener('click', function() {
            // Si le menu est masqué, l'afficher. Sinon, le masquer.
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        });
    </script>


</header>