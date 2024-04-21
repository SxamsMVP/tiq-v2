<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/inscription.css">
    <script>
        function previewImage(input) {
            var preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block"; // Afficher l'aperçu
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = ""; // Effacer l'aperçu si aucun fichier n'est sélectionné
                preview.style.display = "none"; // Cacher l'aperçu
            }
        }
    </script>
</head>

<body>
    <!-- En-tête -->
    <div class="header">
        <div class="logo">
            <img src="img/logo.png" alt="Logo SQL CHALLENGER">
        </div>
        <div class="header-title text-center">SQL CHALLENGER</div>
        <div class="header-links">
            <a class="text-black mr-3" href="connexion.php">Connexion</a>
        </div>
    </div>
    <div class="container mt-3">
        <h1 class="text-center text-black mb-4">Bienvenue !</h1>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="traitement_inscription.php" method="post" enctype="multipart/form-data">
                    <h4 class="text-left text-primary mb-4">CRÉEZ VOTRE COMPTE !</h4>
                    <div class="form-group"> <!-- Suppression de la classe row pour ne pas aligner les éléments sur la même ligne -->
                        <label for="email" class="form-label text-black">Votre email :</label> <!-- Utilisation de form-label pour une meilleure présentation -->
                        <input type="text" name="email" class="form-control" required placeholder="Adresse mail"> <!-- Changement du type à 'email' et ajout de placeholder -->
                    </div>
                    <div class="form-group">
                        <label for="passwordInput" class="form-label text-black">Votre mot de passe :</label>
                        <div class="input-group">
                            <input type="password" id="passwordInput" name="password" class="form-control" required placeholder="Mot de passe">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fa fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                        <p class="text-secondary small mt-2">Votre mot de passe doit contenir au minimum : 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial (& @ +...)</p>
                    </div>

                    <h4 class="text-left text-primary mb-4 mt-4">DÎTES-NOUS EN PLUS SUR VOUS...</h4>

                    <div class="form-group">
                        <label class="text-black">Civilité :</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="civilite" id="homme" value="Homme" required>
                                <label class="form-check-label" for="homme">Monsieur</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="civilite" id="femme" value="Femme" required>
                                <label class="form-check-label" for="femme">Madame</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"> <!-- Suppression de la classe row pour ne pas aligner les éléments sur la même ligne -->
                        <label for="prenom" class="form-label text-black">Votre Prénom :</label> <!-- Utilisation de form-label pour une meilleure présentation -->
                        <input type="text" name="prenom" class="form-control" required placeholder="Votre Prénom"> <!-- Changement du type à 'email' et ajout de placeholder -->
                    </div>
                    <div class="form-group"> <!-- Suppression de la classe row pour ne pas aligner les éléments sur la même ligne -->
                        <label for="nom" class="form-label text-black">Votre Nom :</label> <!-- Utilisation de form-label pour une meilleure présentation -->
                        <input type="text" name="nom" class="form-control" required placeholder="Votre Nom"> <!-- Changement du type à 'email' et ajout de placeholder -->
                    </div>

                    <h4 class="text-left text-primary mb-4 mt-4">QUELLES SONT VOS COORDONNÉES ?</h4>

                    <div class="form-group"> <!-- Suppression de la classe row pour ne pas aligner les éléments sur la même ligne -->
                        <label for="pays" class="form-label text-black">Votre Pays :</label> <!-- Utilisation de form-label pour une meilleure présentation -->
                        <input type="text" name="pays" class="form-control" required placeholder="France"> <!-- Changement du type à 'email' et ajout de placeholder -->
                    </div>
                    <div class="form-group"> <!-- Suppression de la classe row pour ne pas aligner les éléments sur la même ligne -->
                        <label for="phone" class="form-label text-black">Votre numéro de téléphone :</label> <!-- Utilisation de form-label pour une meilleure présentation -->
                        <input type="text" name="phone" class="form-control" required placeholder="06 06 06 06 06"> <!-- Changement du type à 'email' et ajout de placeholder -->
                    </div>

                    <h4 class="text-left text-primary mb-4 mt-4">QUI ÊTES VOUS VRAIMENT ?</h4>
                    <div class="form-group row text-black pl-3">
                        <label for="photo" class="form-label text-black mr-3">Choisissez une photo de profil :</label>
                        <div class="col-sm-4">
                            <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(this)" class="form-control-file photo-profil">
                        </div>
                        <!-- Ajout d'un conteneur pour l'aperçu de l'image à côté -->
                        <img id="preview" src="#" alt="Aperçu de la photo" class="photo-profil-preview" style="display: none;">
                    </div>


                    <div class="form-group mb-4"> <!-- Suppression de la classe row pour ne pas aligner les éléments sur la même ligne -->
                        <label for="pseudo" class="form-label text-black">Votre pseudo :</label> <!-- Utilisation de form-label pour une meilleure présentation -->
                        <input type="text" name="pseudo" class="form-control" required placeholder="Je suis un boss sql :)"> <!-- Changement du type à 'email' et ajout de placeholder -->
                    </div>
                    <div class="form-group row text-black">
                        <div class="col-sm-12"> <!-- Modifié pour prendre toute la largeur de sa rangée sans décalage -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="termsCheckbox" required>
                                <label class="form-check-label" for="termsCheckbox">
                                    J'accepte les <a href="#" class="text-black">conditions générales</a>.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-black mt-3">
                        <div class="text-center"> <!-- Classe text-center pour centrer le bouton -->
                            <button class="btn btn-primary btn-lg btn-block" type="submit">CRÉER VOTRE COMPTE</button> <!-- Ajout de la classe btn-block -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-section col-md-4">
                        <h4>À propos</h4>
                        <p>Nous sommes une entreprise dédiée à [description de l'entreprise]. Rejoignez-nous pour explorer et découvrir plus ensemble.</p>
                    </div>
                    <div class="footer-section col-md-4">
                        <h4>Contactez-nous</h4>
                        <ul>
                            <li><a href="mailto:info@votreentreprise.com">info@votreentreprise.com</a></li>
                            <li><a href="tel:+1234567890">+1 234 567 890</a></li>
                        </ul>
                    </div>
                    <div class="footer-section col-md-4">
                        <h4>Suivez-nous</h4>
                        <a href="http://www.facebook.com">Facebook</a>
                        <a href="http://www.twitter.com">Twitter</a>
                        <a href="http://www.instagram.com">Instagram</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Ajoutez ici votre script JavaScript pour l'aperçu de l'image -->
        <script>
            function previewImage(input) {
                var preview = document.getElementById('preview');
                var file = input.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            }
            document.getElementById('togglePassword').addEventListener('click', function(e) {
                const passwordInput = document.getElementById('passwordInput');
                const passwordIcon = document.getElementById('eyeIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordIcon.className = 'fa fa-eye-slash'; // Change icon to eye-slash when visible
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.className = 'fa fa-eye'; // Change icon back to eye when hidden
                }
            });
        </script>
</body>

</html>