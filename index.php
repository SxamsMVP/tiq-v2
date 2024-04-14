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
    <title>SQL CHALLENGER</title>
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
            <img class="imgcours1" src="/img/logoCours.png" alt="">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-100 dark:text-white">Cours</h5>
            </a>
            <p class="mb-3 font-normal text-gray-100 dark:text-gray-100">Accédez à nos cours afin de maîtriser les bases du SQL.</p>
        </div>
    </div>

    <div class="col-md-4">
    <a href="accueil_exercice.php">
        <div class="footer-sidebar bg-white text-black text-center">
            <img class="imgcours2" src="/img/logoCours.png" alt="">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-100 dark:text-white">Exercices</h5>
            </a>
            <p class="mb-3 font-normal text-gray-100 dark:text-gray-100">Mettez vos connaissances en pratique avec nos exercices interactifs. Testez vos compétences en résolvant des problèmes SQL et en obtenant un retour immédiat.</p>
        </div>
    </div>

    <div class="col-md-4">
    <a href="forum.php">
        <div class="footer-sidebar bg-white text-black text-center">
            <img class="imgcours3" src="/img/logoCours.png" alt="">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-100 dark:text-white">Forum</h5>
            </a>
            <p class="mb-3 font-normal text-gray-100 dark:text-gray-100">Echanges - Question / Réponses avec les autres utilisateurs. N'hésitez pas !</p>
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
</body>

</html>