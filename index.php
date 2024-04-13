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
    <link rel="stylesheet" href="style/header_menu.css">
    <title>Bannière avec navigation</title>
</head>

<body>

    <div class="header">

        <div class="logo">
            <img src="img/logo.png" alt="Logo SQL CHALLENGER">
        </div>

        <div class="header-title text-left">
            <a href="index.php" style="text-decoration: none; color: inherit;">SQL CHALLENGER</a>
        </div>

        <div class="header-content">
            <div class="header-links">
                <?php
                // Affichez les liens de connexion/inscription ou de données du compte/déconnexion en fonction de la connexion de l'utilisateur
                if (isset($_SESSION['username'])) {

                    // Affichez la photo de profil si le chemin est disponible
                    if (!empty($userData['photo_path'])) {
                        echo '<img src="' . $userData['photo_path'] . '" alt="Photo de profil" class="profile-photo">';
                    }
                    echo '<a href="account.php">' . ucwords($username) . '</a>';
                    if ($userData['admin']) {
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
    </div>

    <!-- Menu horizontal -->
    <div class="menu">
        <a href="cours.php">Cours</a>
        <a href="accueil_exercice.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>

    <div class="banner">
        <img src="img/banniere1.jpg" alt="Bannière 1">
        <img src="img/banniere2.jpeg" alt="Bannière 2">
        <img src="img/banniere3.png" alt="Bannière 3">
        <div class="prev" onclick="prevSlide()">&#10094;</div>
        <div class="next" onclick="nextSlide()">&#10095;</div>
    </div>

    <script>
        var currentSlide = 0;
        var slides = document.querySelectorAll('.banner img');

        function showSlide() {
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
            }
            slides[currentSlide].style.display = 'block';
        }

        function prevSlide() {
            currentSlide--;
            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }
            showSlide();
        }

        function nextSlide() {
            currentSlide++;
            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }
            showSlide();
        }

        showSlide();
    </script>


    <section class="main-content">
        <div class="container">
            <h2>Bienvenue sur SQL CHALLENGER</h2>
            <p>Découvrez le monde de SQL et améliorez vos compétences en bases de données avec notre plateforme éducative interactive. Que vous soyez débutant ou expert, notre site offre une variété de ressources pour vous aider à apprendre et à pratiquer SQL.</p>
            
            
            
            <div class="row justify-content-between">
    <div class="col-md-4">
    <a href="cours.php">
        <div class="footer-sidebar bg-white text-black text-center">
            <img class="imgcours" src="/img/courssql.png" alt="">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-100 dark:text-white">Cours</h5>
            </a>
            <p class="mb-3 font-normal text-gray-100 dark:text-gray-100">Accédez à nos cours pour pouvoir vous entraîner.</p>
        </div>
    </div>

    <div class="col-md-4">
    <a href="accueil_exercice.php">
        <div class="footer-sidebar bg-white text-black text-center">
            <img class="imgcours" src="/img/courssql.png" alt="">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-100 dark:text-white">Exercices</h5>
            </a>
            <p class="mb-3 font-normal text-gray-100 dark:text-gray-100">Mettez vos connaissances en pratique avec nos exercices interactifs. Testez vos compétences en résolvant des problèmes SQL et en obtenant un retour immédiat. Améliorez votre compréhension et votre maîtrise de SQL en pratiquant.</p>
        </div>
    </div>

    <div class="col-md-4">
    <a href="forum.php">
        <div class="footer-sidebar bg-white text-black text-center">
            <img class="imgcours" src="/img/courssql.png" alt="">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-100 dark:text-white">Forum</h5>
            </a>
            <p class="mb-3 font-normal text-gray-100 dark:text-gray-100">Forum food.</p>
        </div>
    </div>
</div>
<!--                 <div class="col-md-6">
                    <h3>Exercices pratiques</h3>
                    <p>Mettez vos connaissances en pratique avec nos exercices interactifs. Testez vos compétences en résolvant des problèmes SQL et en obtenant un retour immédiat. Améliorez votre compréhension et votre maîtrise de SQL en pratiquant.</p>
                    <a href="exercices.php" class="btn btn-primary">Commencer les exercices</a>
                </div>
            </div> -->
        </div>
    </section>


    <!-- Barre latérale en bas -->
    <div class="footer-sidebar bg-dark  text-white text-center p-3">
        <h4>Coordonnées de l'entreprise</h4>
        <p>Adresse : Université de Bordeaux</p>
        <p>Téléphone : 06 06 06 06 06</p>
        <p>Email : sqlchallenger@gmail.com</p>
    </div>
</body>

</html>