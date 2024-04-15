<?php
session_start();
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/accueil.css">
    <title>SQL CHALLENGER</title>
</head>

<body>
    <div class="header">
        <div class="header-content">
            <div class="header-links">
                <?php
                // Affichez les liens de connexion/inscription ou de données du compte/déconnexion en fonction de la connexion de l'utilisateur
                if (isset($_SESSION['username'])) {

                    // Affichez la photo de profil si le chemin est disponible
                    if (!empty($userData['photo_path'])) {
                        echo '<img src="' . $userData['photo_path'] . '" alt="Photo de profil" class="profile-photo">';
                    }
                    echo '<a class="text-white" href="account.php">' . ucwords($username) . '</a>';
                    if ($userData['admin']) {
                        echo '<a class="text-white" href="back_office.php">Admin</a>';
                    }
                    echo '<a class="text-white" href="logout.php">Déconnexion</a>';
                } else {
                    echo '<a href="connexion.php">Connexion</a>';
                    echo '<a href="inscription.php">Inscription</a>';
                }
                ?>
            </div>
        </div>
    </div>
    <header class="header">
            <div class="logo">
                <img src="img/logo.png" alt="Logo SQL CHALLENGER">
            </div>
            <h1 class="header-title">SQL CHALLENGER</h1>
        </header>
    <section class="main-content">
   
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 text-center">
                    <a href="cours.php" class="btn-large blue-bg">Cours</a>
                </div>

                <div class="col-md-4 text-center">
                    <a href="accueil_exercice.php" class="btn-large blue-bg">Exercices</a>
                </div>

                <div class="col-md-4 text-center">
                    <a href="forum.php" class="btn-large blue-bg">Forum</a>
                </div>
            </div>
        </div>
    </section>

</body>

</html>