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
    
    <link rel="stylesheet" href="style/accueil_exercice.css">
    <style>
    </style>
</head>

<body>
    <!-- Header -->
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
                if (!empty($userData['photo_path'])) {
                    echo '<img src="' . $userData['photo_path'] . '" alt="Photo de profil" class="profile-photo">';
                }
                echo '<a href="account.php">' . $_SESSION['username'] . '</a>';
                if (!empty($userData['admin'])) {
                    echo '<a href="back_office.php">Admin</a>';
                }
                echo '<a href="logout.php">Déconnexion</a>';
            } else {
                echo '<a href="connexion.php">Connexion</a>';
                echo '<a href="inscription.php">Inscription</a>';
            }
            ?>
        </div>
    </div>

    <!-- Horizontal Menu -->
    <div class="menu">
        <a href="cours.php">Cours</a>
        <a href="accueil_exercice.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>

    <!-- Exercise Selection Sections -->
    <div class="container exercise-section">
        <div class="row">
            <!-- Full-Width SQL Queries Section -->
            <div class="col-12">
                <div class="card full-width-card">
                    <img src="img/sql_exercice.png" alt="Quête SQL : L'Odyssée des Requêtes">
                    <div class="card-body">
                        <h5 class="card-title">Quête SQL : L'Odyssée des Requêtes</h5>
                        <a href="parcours_exercice.php" class="btn btn-primary">Débuter l'aventure</a>
                    </div>
                </div>
            </div>
            <!-- Other Sections -->
            <div class="col-md-6">
                <div class="card full-width-card">
                    <img src="img/select_exercice.png" alt="Exercice Select">
                    <div class="card-body">
                        <h5 class="card-title">Exercice SELECT</h5>
                        <a href="select_exercices.php" class="btn btn-primary">Débuter l'exercice</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-width-card">
                    <img src="img/where_exercice.png" alt="SQL Exercise WHERE">
                    <div class="card-body">
                        <h5 class="card-title">Exercice WHERE</h5>
                        <a href="where_exercices.php" class="btn btn-primary">Débuter l'exercice</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-width-card">
                    <img src="img/groupeby_exercice.png" alt="SQL GROUPE BY">
                    <div class="card-body">
                        <h5 class="card-title">Exercice GROUPE BY</h5>
                        <a href="groupeby_exercices.php" class="btn btn-primary">Débuter l'exercice</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-width-card">
                    <img src="img/join_exercice.png" alt="SQL Exercise JOIN">
                    <div class="card-body">
                        <h5 class="card-title">Exercice JOIN</h5>
                        <a href="join_exercices.php" class="btn btn-primary">Débuter l'exercice</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card full-width-card">
                    <img src="img/having_exercice.png" alt="SQL Exercise HAVING">
                    <div class="card-body">
                        <h5 class="card-title">Exercice HAVING</h5>
                        <a href="having_exercices.php" class="btn btn-primary">Débuter l'exercice</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card full-width-card">
                    <img src="img/aggregation_exercice.png" alt="SQL Exercise AGGREGATION">
                    <div class="card-body">
                        <h5 class="card-title">Exercice AGGREGATION</h5>
                        <a href="aggregation_exercices.php" class="btn btn-primary">Débuter l'exercice</a>
                    </div>
                </div>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>