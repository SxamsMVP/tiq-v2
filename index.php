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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/accueil.css">
    <title>SQL CHALLENGER</title>
</head>

<body>
    <div class="header mt-4">
        <div class="header-content mt-3">
            <div class="header-links">
                <?php
                // Affichez les liens de connexion/inscription ou de données du compte/déconnexion en fonction de la connexion de l'utilisateur
                if (isset($_SESSION['username'])) {

                    // Affichez la photo de profil si le chemin est disponible
                    if (!empty($userData['photo_path'])) {
                        echo '<img src="' . $userData['photo_path'] . '" alt="Photo de profil" class="profile-photo">';
                    }
                    echo '<a class="text-white stylish-username" href="account.php">' . ucwords($username) . '</a>';
                    if ($userData['admin']) {
                        echo '<a class="text-white" href="back_office.php"><i class="fa-solid fa-gear icon-large"></i></a>';
                    }
                    
                    echo '<a class="text-white" href="logout.php"><i class="fa-solid fa-right-from-bracket logout-icon"></i></a>';
                } else {
                    echo '<a href="connexion.php">Connexion</a>';
                    echo '<a href="inscription.php">Inscription</a>';
                }
                ?>
            </div>
        </div>
    </div>
    <section class="main-content">

    <div class="header mt-4">
        <div class="logo">
            <img src="img/logo.png" alt="Logo SQL CHALLENGER">
        </div>
        <h1 class="header-title mt-4"><span class="highlight">S</span>QL <span class="highlight">C</span>HALLENGER</h1>

    </div>
        <div class="container mt-4">
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
    <footer class="footer">
    <div class="container">
        <p>By continuing I agree with <a href="#terms" class="footer-link">Terms & Conditions</a>, <a href="#privacy" class="footer-link">Privacy Policy</a>, and <a href="#cookie" class="footer-link">Cookie Policy</a>.</p>
    </div>
</footer>
</body>

</html>