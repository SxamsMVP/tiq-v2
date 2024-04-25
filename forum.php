<?php
session_start();
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CHALLENGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/header_menu.css">
    <link rel="stylesheet" href="style/forum.css">
    <style>
        .center-title {
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


    <div class="container">
        <!-- Forum Content -->
        <a href="#" class="btn btn-primary">Créer un nouveau sujet</a>
        <div class="forum-content">
            <!-- Category 1 -->
            <div class="category-card">
                <h2 class="category-title">Catégorie 1 - Base SQL</h2>
                <ul class="topic-list">
                    <li class="topic-item">
                        <div class="topic-title">SELECT</div>
                        <div class="topic-details">Je ne comprend pas l'utilisation du SELECT </div>
                        <div class="topic-details">Posted by User1 - 3 hours ago</div>
                    </li>
                    <li class="topic-item">
                        <div class="topic-title">SELECT *</div>
                        <div class="topic-details">A quoi sert le * ? récupère t'il toute les informations </div>
                        <div class="topic-details">Posted by User2 - 1 day ago</div>
                    </li>
                </ul>
                <a href="#" class="btn btn-secondary">Répondre</a>
            </div>
        </div>
    </div>
    
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


    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>