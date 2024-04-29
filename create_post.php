<?php
session_start();
include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])) {
    $content = SQLite3::escapeString($_POST['content']);
    $user_id = $_SESSION['user_id'];  // Assurez-vous que l'utilisateur est connecté

    $sql = "INSERT INTO posts (user_id, content) VALUES ('$user_id', '$content')";
    if ($bdd->exec($sql)) {
        header("Location: forum.php");
    } else {
        echo "Erreur lors de l'ajout du post.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CHALLENGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="style/exercices.css">
    <style>
        body {
            background-color: #202b3f;
            font-family: Arial, sans-serif;
        }

        .form-post {
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin-bottom: 100px;
            margin-top: 100px;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            resize: none;
        }

        button {
            background-color: #202b3f;
            color: white;
            padding: 10px 60px;
            border: none;
            border-radius: 4px;
            cursor: pointer;

        }

        button:hover {
            background-color: #004494;
        }

        .error {
            color: red;
            text-align: center;
        }

        .warning-text small {
            display: block;
            margin-top: 0px;
            font-size: 12px;
            color: #666;
            text-align: center;
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


        .logout-icon {
            color: red;
            /* Set the icon color to red */
            font-size: 1.5rem;
        }
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

    <div class="container form-post ">
        <h2 class="mt-3">Créer un nouveau post</h2>
        <form action="" method="post">
            <textarea class="mt-3" name="content" required placeholder="Écrivez votre message ici..."></textarea>
            <button class="mt-3" type="submit">Publier</button>
        </form>
        <div class="warning-text mt-4">
            <small>Tout comportement inapproprié peut entraîner des restrictions d'accès ou un bannissement du forum. Veuillez respecter les règles de la communauté.</small>
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
</body>

</html>