<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/inscription.css">
    <style>
        body {
            background-image: url('img/fond_ecran.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
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
        <div class="photo-preview-container mt-2">
            <img id="preview" src="#" alt="Aperçu de la photo" class="photo-profil-preview" style="display: none;">
        </div>
        <div class="header-links">
            <a class="text-white mr-3" href="connexion.php">Connexion</a>
        </div>
    </div>
    <div class="container mt-3">
        <h1 class="text-center text-white mb-4">Inscription</h1>
        <div class="col-md-10 offset-md-1">
            <form action="traitement_inscription.php" method="post" enctype="multipart/form-data">
                <div class="form-group row text-white">
                    <label for="photo" class="col-sm-2 col-form-label">Choisissez une photo de profil :</label>
                    <div class="col-sm-4">
                        <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(this)"
                            class="form-control-file photo-profil">
                    </div>

                    <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row text-white">
                    <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
                    <div class="col-sm-4">
                        <input type="text" name="prenom" class="form-control" required>
                    </div>

                    <label for="adresse" class="col-sm-2 col-form-label">Adresse :</label>
                    <div class="col-sm-4">
                        <input type="text" name="adresse" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row text-white">
                    <label for="email" class="col-sm-2 col-form-label">Adresse e-mail :</label>
                    <div class="col-sm-4">
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <label for="username" class="col-sm-2 col-form-label">Pseudo :</label>
                    <div class="col-sm-4">
                        <input type="text" name="username" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row text-white">
                    <label for="password" class="col-sm-2 col-form-label">Mot de passe :</label>
                    <div class="col-sm-4">
                        <input type="password" id="passwordInput" name="password" class="form-control" required>
                    </div>

                    <label for="confirm_password" class="col-sm-2 col-form-label">Confirmer le mot de passe :</label>
                    <div class="col-sm-4">
                        <input type="password" id="confirmPasswordInput" name="confirm_password" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row text-white">
                    <div class="col-sm-9 offset-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">
                                J'accepte les <a href="#" class="text-white">conditions générales</a>.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group  text-white">
                    <div class=" text-center"> <!-- Ajout de la classe text-center -->
                        <button class="btn btn-success btn-lg text-center" type="submit">S'inscrire</button> <!-- Ajout de la classe btn-lg -->
                    </div>
                </div>

            </form>
            <a href="index.php" class="mt-3 d-block text-center text-white">Retour à la page d'accueil</a>
        </div>
    </div>



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
    </script>
</body>

</html>