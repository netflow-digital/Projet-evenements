<script src="https://kit.fontawesome.com/705902a3b9.js" crossorigin="anonymous"></script>

<header>
    <div class="contenant">
        <ul>
            <li><a href="index.php?page=accueil">Evénements</a></li>
            <li><a href="index.php?page=contact">Nous contacter</a></li>
            <li><a href="">A propos</a></li>
            <li><i class="fa-solid fa-user fa-2x" id="menu-icon"></i></li>

        </ul>
    </div>

    <nav id="menuConnexion">
        <ul>
            <li><?php if (!isset($_SESSION["id_utilisateurs"])) : ?><a href="index.php?page=connexion">Se connecter</a><?php endif ?></li>
            <li> <?php if (isset($_SESSION["id_utilisateurs"])) : ?><a href="deconnexion.php">Se déconnecter</a><?php endif ?></li>
            <li><?php if (isset($_SESSION["id_utilisateurs"])) : ?><a href="index.php?page=monCompte">Mon compte</a><?php endif ?></li>
            <li><?php if (isset($_SESSION["id_utilisateurs"])) : ?><a href="index.php?page=listeEvents">Mes événements</a><?php endif ?></li>
            <li><?php if (isset($_SESSION['role_utilisateurs']) && $_SESSION['role_utilisateurs'] == 'admin') : ?><a href="index.php?page=creationEvent"> Créer un événement </a><?php endif ?> </li>
            <li><?php if (isset($_SESSION['role_utilisateurs']) && $_SESSION['role_utilisateurs'] == 'admin') : ?><a href="index.php?page=utilisateurs"> Liste des utilisateurs </a><?php endif ?> </li>
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