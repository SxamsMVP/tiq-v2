<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CHALLENGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/header_menu.css">
    <link rel="stylesheet" href="style/cour.css">

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
            // Affichez les liens de connexion/inscription ou de données du compte/déconnexion en fonction de la connexion de l'utilisateur
            if (isset($_SESSION['username'])) {
                
                // Affichez la photo de profil si le chemin est disponible
                if (!empty($userData['photo_path'])) {
                    echo '<img src="' . $userData['photo_path'] . '" alt="Photo de profil" class="profile-photo">';
                }
                echo '<a href="account.php">' . $username . '</a>';
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

    <!-- Menu horizontal -->
    <div class="menu">
        <a href="cours.php">Cours</a>
        <a href="exercices.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Barre latérale -->
            <div class="col-md-2 sidebar">
                <h3 style="color: white">Catégories</h3>
                <ul>
                    <li>
                        <a href="#" onclick="changeContent('SELECT')">SELECT</a>
                        <ul>
                            <li><a href="#" onclick="changeContent('SELECT DISTINCT')">SELECT DISTINCT</a></li>
                        </ul>
                    </li>
                    <li><a href="#" onclick="changeContent('WHERE')">WHERE</a></li>
                        <ul>
                            <li><a href="#" onclick="changeContent('AND & OR')">AND & OR</a></li>
                            <li><a href="#" onclick="changeContent('IN')">IN</a></li>
                            <li><a href="#" onclick="changeContent('BETWEEN')">BETWEEN</a></li>
                            <li><a href="#" onclick="changeContent('LIKE')">LIKE</a></li>
                        </ul>
                    <li><a href="#" onclick="changeContent('GROUP BY')">GROUP BY</a></li>
                    <li><a href="#" onclick="changeContent('HAVING')">HAVING</a></li>
                    <li><a href="#" onclick="changeContent('Jointure')">Jointure</a></li>
                    <li><a href="#" onclick="changeContent('Aggregations')">Aggregations</a></li>
                </ul>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-10 main-content">
                <article id="post-11" class="post-11 page type-page status-publish hentry">

                    <!-- Contenu initial -->
                    <h1 class="center-title">Apprendre le SQL</h1>
                    <p>Le SQL, ou Structured Query Language, est un langage utilisé pour interagir avec les bases de données. 
                        Principalement adopté par les développeurs web, il permet de manipuler les données d'un site internet. 
                        SQL.sh propose des cours et des explications sur les commandes essentielles permettant de lire, insérer, 
                        mettre à jour et supprimer des données dans une base de données.</p>
                    <h1 class="center-title">Cours</h1>
                    <p>Les cours sont conçus pour vous enseigner les commandes SQL essentielles telles que SELECT, INSERT INTO, UPDATE, DELETE, DROP TABLE, entre autres. Chaque commande est expliquée à travers des exemples clairs et succincts, offrant ainsi une formation pratique. En complément de la liste des commandes SQL, les cours proposent également des fiches mnémotechniques décrivant les fonctions SQL telles que AVG(), COUNT(), MAX(), etc. Ces ressources sont précieuses pour renforcer votre maîtrise du SQL.</p>

                </article>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function changeContent(category) {
            // Récupérer l'élément avec l'ID "content"
            var contentElement = document.getElementById('content');

            // Modifier le contenu en fonction de la catégorie
            switch (category) {
                case 'SELECT':
                    contentElement.innerHTML = '<h1>SELECT</h1><p>Contenu pour SELECT</p>';
                    break;
                case 'SELECT DISTINCT':
                    contentElement.innerHTML = '<h1>SELECT DISTINCT</h1><p>Contenu pour SELECT DISTINCT</p>';
                    break;
                case 'WHERE':
                    contentElement.innerHTML = '<h1>WHERE</h1><p>Contenu pour WHERE...</p>';
                    break;
                case 'AND & OR':
                    contentElement.innerHTML = '<h1>AND & OR</h1><p>Contenu pour et & ou</p>';
                    break;
                case 'IN':
                    contentElement.innerHTML = '<h1>IN</h1><p>Contenu pour IN</p>';
                    break;
                case 'BETWEEN':
                    contentElement.innerHTML = '<h1>BETWEEN</h1><p>Contenu pour BETWEEN</p>';
                    break;
                case 'LIKE':
                    contentElement.innerHTML = '<h1>LIKE</h1><p>Contenu pour LIKE</p>';
                    break;
                case 'GROUP BY':
                    contentElement.innerHTML = '<h1>GROUP BY</h1><p>Contenu pour GROUP BY</p>';
                    break;
                case 'HAVING':
                    contentElement.innerHTML = '<h1>HAVING</h1><p>Contenu pour HAVING</p>';
                    break;                 
                case 'Jointure':
                    contentElement.innerHTML = '<h1>Jointure</h1><p>test</p>';
                    break;
                    
                case 'Aggregations':
                    contentElement.innerHTML = '<h1>Aggregations</h1><p>Contenu pour Aggregations...</p>';
                    break;
                default:
                    contentElement.innerHTML = '<p>Sélectionnez une catégorie pour afficher le contenu correspondant.</p>';
            }
        }
    </script>

</body>

</html>
