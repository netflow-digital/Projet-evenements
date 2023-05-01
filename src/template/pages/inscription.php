<h1> S'inscrire</h1>


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