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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>