<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}

// Récupérer les informations du compte de l'utilisateur depuis la base de données
$bdd = new SQLite3('database.sqlite');

// Vérification de la connexion
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}

// Utilisez la variable $_SESSION['username'] pour récupérer les informations spécifiques de l'utilisateur depuis la base de données
$username = $_SESSION['username'];
$query = "SELECT * FROM utilisateurs WHERE username = :username";
$stmt = $bdd->prepare($query);
$stmt->bindParam(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute();
$userData = $result->fetchArray(SQLITE3_ASSOC);

// Traitement du formulaire de mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newNom = $_POST['new_nom'];
    $newPrenom = $_POST['new_prenom'];
    $newEmail = $_POST['new_email'];
    $newPhone = $_POST['new_phone'];
    $newPays = $_POST['new_pays'];

    // Mettre à jour les données de l'utilisateur dans la base de données
    $updateQuery = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, phone = :phone, pays = :pays WHERE username = :username";
    $updateStmt = $bdd->prepare($updateQuery);
    $updateStmt->bindParam(':nom', $newNom, SQLITE3_TEXT);
    $updateStmt->bindParam(':prenom', $newPrenom, SQLITE3_TEXT);
    $updateStmt->bindParam(':email', $newEmail, SQLITE3_TEXT);
    $updateStmt->bindParam(':username', $username, SQLITE3_TEXT);
    $updateStmt->bindParam(':phone', $newPhone, SQLITE3_TEXT);
    $updateStmt->bindParam(':pays', $newPays, SQLITE3_TEXT);

    // Exécuter la mise à jour
    $updateResult = $updateStmt->execute();

    if ($updateResult) {
        // Mise à jour réussie, rediriger avec un message de succès
        header('Location: account.php?success=1');
        exit();
    } else {
        // Mise à jour échouée, rediriger avec un message d'erreur
        header('Location: account.php?error=' . urlencode('Erreur lors de la mise à jour'));
        exit();
    }
}

// Fermer la connexion
$bdd->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/header_menu.css">
    <style>
        body {
            background-color: #202b3f;
        }

        .container {
            background: white;
            /* Fond blanc pour le conteneur principal */
            border-radius: 8px;
            /* Bords arrondis pour le conteneur */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Ombre légère pour le conteneur */
            padding: 20px;
            /* Espacement intérieur pour le conteneur */
            margin-top: 50px;
            /* Marge supérieure pour soulever le conteneur */
        }

        .btn-danger,
        .btn-success {
            width: 48%;
            /* Largeur des boutons pour les aligner côte à côte */
        }

        .form-control {
            border: 2px solid #ccc;
            /* Bordure plus distincte pour les champs de formulaire */
            border-radius: 5px;
            /* Bords légèrement arrondis pour les champs */
        }

        label {
            font-weight: bold;
            /* Texte en gras pour les labels */
        }


        .footer-basic {
            margin-top: 100px;
            padding: 20px 0;
            background-color: #ffffff;
            color: white;
            color: #000000;
        }

        .footer-basic ul {
            padding: 0;
            list-style: none;
            text-align: center;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .footer-basic li {
            padding: 0 10px;
        }

        .footer-basic ul a {
            color: inherit;
            text-decoration: none;
            opacity: 0.8;
        }

        .footer-basic ul a:hover {
            opacity: 1;
        }

        .footer-basic .social {
            text-align: center;
            padding-bottom: 15px;
        }

        .footer-basic .social>a {
            font-size: 24px;
            width: 40px;
            height: 40px;
            line-height: 40px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            border: 1px solid #ccc;
            margin: 0 8px;
            color: inherit;
            opacity: 0.75;
        }

        .footer-basic .social>a:hover {
            opacity: 0.9;
        }

        .footer-basic .copyright {
            margin-top: 10px;
            text-align: center;
            font-size: 13px;
            color: #aaa;
            margin-bottom: 10px;
            margin-top: 20px;
        }
    </style>
    </style>
</head>

<body>
    <!-- En-tête -->
    <div class="header">
        <div class="logo">
            <img src="img/logo.png" alt="Logo SQL CHALLENGER">
        </div>
        <div class="header-title text-center">
            <a href="index.php" style="text-decoration: none; color: inherit;">SQL CHALLENGER</a>
        </div>
        <div class="header-links">
            <?php
            if (isset($_SESSION['username'])) {

                // Affichez la photo de profil si le chemin est disponible
                if (!empty($userData['photo_path'])) {
                    echo '<img src="' . $userData['photo_path'] . '" alt="Photo de profil" class="profile-photo">';
                }
                echo '<a class="text-white stylish-username" href="account.php">' . ucwords($username) . '</a>';
                if ($userData['admin']) {
                    echo '<a class="text-white" href="back_office.php"><i class="fa-solid fa-gear icon-large"></i></a>';
                }

                echo '<a class="text-red" href="logout.php"><i class="fa-solid fa-right-from-bracket logout-icon"></i></a>';
            } else {
                echo '<a href="connexion.php">Connexion</a>';
                echo '<a href="inscription.php">Inscription</a>';
            }
            ?>
        </div>
    </div>

    <!-- Menu horizontal -->
    <div class="menu">
        <a href="cours.php">Cours</a>
        <a href="accueil_exercice.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>
    <div class="container">
        <?php
        // Vérifiez si le paramètre 'success' est dans l'URL
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success text-center">Sauvegarde réussie !</div>';
        }

        // Vérifiez si le paramètre 'error' est dans l'URL
        if (isset($_GET['error'])) {
            $errorMsg = htmlspecialchars($_GET['error']);
            echo "<div class='alert alert-danger text-center'>Erreur lors de la mise à jour: $errorMsg</div>";
        }
        ?>

        <div class="main-content">
            <h1 class="text-info mb-4">Mon Compte</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="new_nom">Nom :</label>
                    <input type="text" name="new_nom" class="form-control" value="<?php echo $userData['nom']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="new_prenom">Prénom :</label>
                    <input type="text" name="new_prenom" class="form-control" value="<?php echo $userData['prenom']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="new_email">Email :</label>
                    <input type="email" name="new_email" class="form-control" value="<?php echo $userData['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="new_pays">Pays :</label>
                    <input type="text" name="new_pays" class="form-control" value="<?php echo $userData['pays']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="new_phone">Téléphone :</label>
                    <input type="text" name="new_phone" class="form-control" value="<?php echo $userData['phone']; ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="account.php" class="btn btn-danger mb-2 mt-2">Annuler</a>
                    <input class="btn btn-success mb-2 mt-2" type="submit" value="Enregistrer les modifications">
                </div>
            </form>
        </div>
    </div>
    <div class="footer-basic">
        <footer>
            <div class="social"><a href="https://www.instagram.com"><i class="icon ion-social-instagram"></i></a><a href="https://www.linkedin.com"><i class="icon ion-social-snapchat"></i></a><a href="https://www.twitter.com"><i class="icon ion-social-twitter"></i></a><a href="https://www.facebook.com"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline mb-3">
                <li class="list-inline-item"><a href="index.php">Accueil</a></li>
                <li class="list-inline-item"><a href="cours.php">Cours</a></li>
                <li class="list-inline-item"><a href="forum.php">Forum</a></li>
                <li class="list-inline-item"><a href="accueil_exercice.php">Exercices</a></li>
            </ul>
            <ul class="list-inline mt-3">
                <li class="list-inline-item"><a>sqlchallenger@gmail.com</a></li>
                <li class="list-inline-item"><a>05 54 05 05 05</a></li>
                <li class="list-inline-item"><a>Université de Bordeaux</a></li>
            </ul>
            <p class="copyright">Copyright SQL CHALLENGER © 2024</p>
        </footer>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>