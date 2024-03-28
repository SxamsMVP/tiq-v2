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
    <link rel="stylesheet" href="style/header_menu.css">
    <style>
        body {
            background-image: url('img/fond_ecran.jpg');
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
    <div class="container mt-5" style="background-color: #c7a4eb; border-radius: 20px;">
        <h3 style="color: #ffffff; font-size: 2rem; font-weight: bold;">Connexion</h3>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group text-white">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group text-white">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col text-right  ">
                <a class="mt-4 text-decoration-underline" href="??">Mot de passe oublié</a>
            </div>

            <div class="text-center mt-4 mb-4"> <!-- Ajout de la classe text-center pour centrer le bouton -->
                <input class="btn btn-success btn-lg" type="submit" value="Connexion"> <!-- Ajout de la classe btn-lg pour agrandir le bouton -->
            </div>
        </form>
        <a class="mt-4" href="inscription.php">Pas de compte ? S'inscrire</a>
    </div>


    <!-- Barre latérale en bas -->
    <div class="footer-sidebar text-white p-4">
        <h4>Coordonnées de l'entreprise</h4>
        <p>Adresse : Université de Bordeaux</p>
        <p>Téléphone : 06 06 06 06 06</p>
        <p>Email : sqlchallenger@gmail.com</p>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>