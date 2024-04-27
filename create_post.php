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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/exercices.css">
    <style>
        body {
            background-image: url('/img/add_question_background.png');
            ;
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
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            resize: none;
            /* Disable resizing */
        }

        button {
            background-color: orange;
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

    <div class="container form-post mt-5">
        <h2 class="mt-3">Créer un nouveau post</h2>
        <form action="" method="post">
            <textarea class="mt-3" name="content" required placeholder="Écrivez votre message ici..."></textarea>
            <button class="mt-3" type="submit">Publier</button>
        </form>
        <div class="warning-text mt-4">
            <small>Tout comportement inapproprié peut entraîner des restrictions d'accès ou un bannissement du forum. Veuillez respecter les règles de la communauté.</small>
        </div>
    </div>
</body>

</html>