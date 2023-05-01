<section class="section1">
    <h1> Contactez-nous</h1>
    <p>Si vous avez des questions n'hésitez pas. <br></p>
</section>

<section class="section2">
    <div class="container">
        <form id="form" action="./formulaire.php" method="post">
            <div>
                <label for="nom">Votre nom <span>*</span> </label><br>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div>
                <label for="prenom"> Votre prénom <span>*</span> </label><br>
                <input type="text" name="prenom" id="prenom" required>
            </div>
            <div>
                <label for="email"> Votre email <span>*</span> </label><br>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="tel"> Votre numéro de téléphone: </label><br>
                <input type="tel" name="tel" id="tel">
            </div>
            <div>
                <p><label for="message"> Votre message <span>*</span> </label></p><br>
                <textarea name="message" id="message" rows="20" placeholder="    Votre message" required></textarea>
            </div>
            <div class="button">
                <input type="submit" id="buttonSubmit" value="valider" disabled>
            </div>
        </form>
    </div>
</section>