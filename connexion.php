<?php
// Démarrer la session au début du fichier
session_start();

$bdd = new SQLite3('database.sqlite');

// Exemple de vérification basique (à améliorer)
$authentication_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitez le formulaire de connexion ici
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Assurez-vous de sécuriser la requête SQL pour éviter les injections
    // ...

    // Exemple de vérification basique (à améliorer)
    // Utilisez password_verify pour vérifier le mot de passe haché
    $sql = "SELECT * FROM utilisateurs WHERE username = :username";

    // Assurez-vous que la connexion à la base de données est réussie
    if ($bdd) {
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':username', $username, SQLITE3_TEXT);
        $result = $stmt->execute();

        // Vérifiez si l'authentification est réussie en utilisant password_verify
        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                $authentication_successful = true;
            }
        }
    }
}

// Ajoutez cette section pour afficher les messages
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert alert-success" role="alert">Vous êtes connecté avec succès !</div>';
} elseif (isset($_GET['error'])) {
    $error_message = htmlspecialchars($_GET['error']);
    echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
}

// Vérifiez l'authentification ici après avoir affiché les messages
if ($authentication_successful) {
    // Stocker des informations de l'utilisateur dans la session
    $_SESSION['username'] = $username;

    // Rediriger vers l'index avec un message de succès
    header('Location: index.php?success=1');
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Rediriger vers la page de connexion avec un message d'erreur
    header('Location: connexion.php?error=Identifiants incorrects');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/connexion.css">
    <style>
        body {
            background-image: url('img/backgroungwall.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="header mb-4">
        <div class="logo">
            <img src="img/logo.png" alt="Logo SQL CHALLENGER">
        </div>
        <div class="header-title">SQL CHALLENGER</div>
    </div>
    <div class="container mt-5" style="background-color: #ffffff; border-radius: 20px; padding: 20px;">
        <h3 style="color: #000000; font-size: 2rem; font-weight: bold; margin-bottom: 20px; text-align: center;">Connexion</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" name="username" class="form-control" placeholder="Entrez votre nom d'utilisateur" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
            </div>
            <div class="text-center mt-3">
                <input class="btn btn-primary btn-lg btn-hover" type="submit" value="Connexion">
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="#" class="text-decoration-underline">Mot de passe oublié</a>
        </div>
        <div class="text-center mt-3">
            <a href="inscription.php">Pas de compte ? S'inscrire !</a>
        </div>
    </div>


    <!-- Barre latérale en bas -->
    <!-- Pied de page -->
    <footer class="footer">
        <div class="footer-info">
            <div class="footer-info__item">
                <h3 class="footer-info__title">Coordonnées de l'entreprise</h3>
                <ul class="footer-info__contact">
                    <li class="footer-info__contact-item">Adresse : Université de Bordeaux</li>
                    <li class="footer-info__contact-item">Téléphone : 06 06 06 06 06</li>
                    <li class="footer-info__contact-item">Email : sqlchallenger@gmail.com</li>
                </ul>
            </div>
            <div class="footer-info__item">
                <!-- Ajoutez ici d'autres informations sur l'entreprise si nécessaire -->
            </div>
            <div class="footer-info__item">
                <h3 class="footer-info__title">Suivez-nous</h3>
                <ul class="footer-info__contact">
                    <li class="footer-info__contact-item"><a href="https://www.facebook.com/jenny.benoispineau/?locale=fr_FR" target="_blank" class="hover:text-white">Facebook</a></li>
                    <li class="footer-info__contact-item"><a href="https://www.facebook.com/jenny.benoispineau/?locale=fr_FR" target="_blank" class="hover:text-white">Twitter</a></li>
                    <li class="footer-info__contact-item"><a href="http://alexandrelourme.free.fr/M1PROC/" target="_blank" class="hover:text-white">Instagram</a></li>
                    <li class="footer-info__contact-item"><a href="https://www.labri.fr/perso/maabout/" target="_blank" class="hover:text-white">LinkedIn</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>

</html>