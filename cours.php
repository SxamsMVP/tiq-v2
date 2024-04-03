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
    <link rel="stylesheet" href="style/header_menu.css">
    <link rel="stylesheet" href="style/cour.css">
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <div class="logo">
            <img src="img/logo.png" alt="Logo SQL CHALLENGER">
        </div>
        <div class="header-title">
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
                    echo '<a href="account.php">' . ucwords($_SESSION['username']) . '</a>';
                    if ($_SESSION['admin']) {
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
        <a href="exercices.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Barre latérale gauche -->
            <div class="col-md-2 sidebar">
                <h3 style="color: white">Catégories</h3>
                <ul>
                    <li>
                        <a href="#" onclick="changeContent('SELECT')">SELECT</a>
                        <ul>
                            <li><a href="#" onclick="changeContent('SELECT DISTINCT')">SELECT DISTINCT</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="changeContent('WHERE')">WHERE</a>
                        <ul>
                            <li><a href="#" onclick="changeContent('AND & OR')">AND & OR</a></li>
                            <li><a href="#" onclick="changeContent('IN')">IN</a></li>
                            <li><a href="#" onclick="changeContent('BETWEEN')">BETWEEN</a></li>
                            <li><a href="#" onclick="changeContent('LIKE')">LIKE</a></li>
                        </ul>
                    </li>
                    <li><a href="#" onclick="changeContent('GROUP BY')">GROUP BY</a></li>
                    <li><a href="#" onclick="changeContent('HAVING')">HAVING</a></li>
                    <li><a href="#" onclick="changeContent('Jointure')">Jointure</a></li>
                    <li><a href="#" onclick="changeContent('Aggregations')">Aggregations</a></li>
                </ul>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-7 main-content">
                <article id="post-11" class="post-11 page type-page status-publish hentry">
                    <!-- Contenu initial -->
                    <h1 class="center-title">Apprendre le SQL</h1>
                    <p>Le SQL, ou Structured Query Language, est un langage utilisé pour interagir avec les bases de données. Principalement adopté par les développeurs web, il permet de manipuler les données d'un site internet. SQL.sh propose des cours et des explications sur les commandes essentielles permettant de lire, insérer, mettre à jour et supprimer des données dans une base de données.</p>
                    <h1 class="center-title">Cours</h1>
                    <p>Les cours sont conçus pour vous enseigner les commandes SQL essentielles telles que SELECT, INSERT INTO, UPDATE, DELETE, DROP TABLE, entre autres. Chaque commande est expliquée à travers des exemples clairs et succincts, offrant ainsi une formation pratique. En complément de la liste des commandes SQL, les cours proposent également des fiches mnémotechniques décrivant les fonctions SQL telles que AVG(), COUNT(), MAX(), etc. Ces ressources sont précieuses pour renforcer votre maîtrise du SQL.</p>
                </article>
            </div>

            <!-- Barre latérale droite -->
            <div class="col-md-3 right-sidebar">
                <h3 style="color: white">Prendre des cours particuliers</h3>
                <ul class="sidebar-list">
                    <li><a href="#">Débutants</a></li>
                    <li><a href="#">Intermédiaires</a></li>
                    <li><a href="#">Avancé</a></li>
                    <li><a href="#">Expert</a></li>
                </ul>

                <h3 style="color: white"> Livres conseillés</h3>
                <ul class="sidebar-list">
                    <li><a href="#">livre</a></li>
                    <li><a href="#">livre</a></li>
                    <li><a href="#">livre</a></li>
                    <li><a href="#">livre</a></li>
                    <li><a href="#">livre</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function changeContent(category) {
            // Récupérer l'élément avec l'ID "post-11" pour le contenu principal
            var contentElement = document.querySelector('.main-content');

            // Modifier le contenu en fonction de la catégorie
            switch (category) {
                case 'SELECT':
    contentElement.innerHTML = `
        <article id="post-11" class="post-11 page type-page status-publish hentry">
            <h1>SELECT</h1>
            <br>
            <p>La syntaxe fondamentale de cette commande est la suivante :</p>
            <p class="sql-command">SELECT nom_du_champ FROM nom_du_tableau</p>
            <p>Cette requête SQL va sélectionner (SELECT) le champ "nom_du_champ" provenant (FROM) du tableau appelé "nom_du_tableau".</p>
            <p>Le SQL, ou Structured Query Language, est un langage utilisé pour interagir avec les bases de données. La commande SELECT est l'une des commandes fondamentales de SQL et est utilisée pour récupérer des données à partir d'une ou plusieurs tables de base de données.</p>
            <p>Voici un exemple :</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>identifiant</th>
                            <th>prénom</th>
                            <th>nom</th>
                            <th>ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pierre</td>
                            <td>Dupond</td>
                            <td>Paris</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sabrina</td>
                            <td>Durand</td>
                            <td>Nantes</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Julien</td>
                            <td>Martin</td>
                            <td>Lyon</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>David</td>
                            <td>Bernard</td>
                            <td>Marseille</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Marie</td>
                            <td>Leroy</td>
                            <td>Grenoble</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p>Cet exemple montre une table "client" avec des informations sur les clients d'une entreprise.</p>
            <p>Si l'on veut avoir la liste de toutes les villes des clients, il suffit d'effectuer la requête SQL ci-dessous :</p>
            <p class="sql-command">SELECT ville FROM client</p>
            <p>De cette manière, on obtient le résultat suivant :</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Paris</td>
                        </tr>
                        <tr>
                            <td>Nantes</td>
                        </tr>
                        <tr>
                            <td>Lyon</td>
                        </tr>
                        <tr>
                            <td>Marseille</td>
                        </tr>
                        <tr>
                            <td>Grenoble</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </article>`;
break;


                case 'SELECT DISTINCT':
                    contentElement.innerHTML = `
                        <article id="post-11" class="post-11 page type-page status-publish hentry">
                            <h1>SELECT DISTINCT</h1>
                            <p>L'usage de la commande SELECT en SQL permet de récupérer toutes les données d'une ou plusieurs colonnes. Cependant, cette commande peut entraîner l'affichage de lignes en doublon. Pour prévenir ces redondances dans les résultats, il suffit d'ajouter DISTINCT après SELECT.</p>
                            <br>
                            <p>La commande de base consiste à exécuter la requête suivante :</p>
                            <p class="sql-command">SELECT DISTINCT ma_colonne FROM nom_du_tableau</p>
                            <p>Cette requête récupère le champ "ma_colonne" de la table "nom_du_tableau" tout en évitant de renvoyer des doublons.</p>
                        </article>`;
                    break;
                case 'WHERE':
                    contentElement.innerHTML = `
                        <article id="post-11" class="post-11 page type-page status-publish hentry">
                            <h1>WHERE</h1>
                            <p>La clause WHERE dans une requête SQL sert à filtrer les lignes d'une base de données en fonction d'une condition spécifique. Elle permet ainsi de sélectionner uniquement les données qui répondent à ce critère, facilitant ainsi l'obtention des informations souhaitées.</p>
                          
                        </article>`;
                    break;
                case 'AND & OR':
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><h1>AND & OR</h1><p>Contenu pour et & ou</p></article>';
                    break;
                case 'IN':
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><h1>IN</h1><p>Contenu pour IN</p></article>';
                    break;
                case 'BETWEEN':
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><h1>BETWEEN</h1><p>Contenu pour BETWEEN</p></article>';
                    break;
                case 'LIKE':
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><h1>LIKE</h1><p>Contenu pour LIKE</p></article>';
                    break;
                case 'GROUP BY':
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><h1>GROUP BY</h1><p>Contenu pour GROUP BY</p></article>';
                    break;
                case 'HAVING':
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><h1>HAVING</h1><p>Contenu pour HAVING</p></article>';
                    break;
                case 'Jointure':
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><h1>Jointure</h1><p>test</p></article>';
                    break;
                case 'Aggregations':
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><h1>Aggregations</h1><p>Contenu pour Aggregations...</p></article>';
                    break;
                default:
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><p>Sélectionnez une catégorie pour afficher le contenu correspondant.</p></article>';
            }
        }
    </script>
</body>
</html>
