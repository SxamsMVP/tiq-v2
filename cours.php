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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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

    <div class="container-fluid">
        <div class="row">
            <!-- Barre latérale gauche -->
            <div class="col-md-3 sidebar">
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
                    <li><a href="#" onclick="changeContent('JOINTURE')">JOINTURE</a></li>
                    <li><a href="#" onclick="changeContent('AGGRAGATIONS')">AGGREGATIONS</a></li>
                </ul>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-6 main-content">
                <article id="post-11" class="post-11 page type-page status-publish hentry">
                    <!-- Contenu initial -->
                    <h1 class="center-title">Apprendre le SQL</h1>
                    <p>Le SQL, ou Structured Query Language, est un langage utilisé pour interagir avec les bases de données. Principalement adopté par les développeurs web, il permet de manipuler les données d'un site internet.</p>
                    <h1 class="center-title">Cours</h1>
                    <p>Les cours sont conçus pour vous enseigner les commandes SQL essentielles telles que <code>SELECT, INSERT INTO, UPDATE, DELETE, DROP TABLE,</code> entre autres. Chaque commande est expliquée à travers des exemples clairs et succincts, offrant ainsi une formation pratique. En complément de la liste des commandes SQL, les cours proposent également des fiches mnémotechniques décrivant les fonctions SQL telles que <code>AVG(), COUNT(), MAX(),</code> etc. Ces ressources sont précieuses pour renforcer votre maîtrise du SQL.</p>
                </article>
                <img src="img/logoCours.png" alt="logo SQL">
            </div>


            <!-- Barre latérale droite -->
            <div class="col-md-3 right-sidebar">
                <h3 style="color: white">Prendre des cours particuliers</h3>
                <ul class="sidebar-list">
                    <li class="mt-3 mb-5"><a  href="mailto:sqlchallenger@gmail.com" >Contactez nous !</a></li>
                </ul>

                <h3 style="color: white"> Livres conseillés</h3>
                <ul class="sidebar-list">
                    <li><a href="https://www.oreilly.com/library/view/learning-sql-3rd/9781492057604/">SQL pour les Nuls</a></li>
                    <li><a href="https://www.oreilly.com/library/view/learning-sql-3rd/9781492057604/">Learning SQL</a></li>
                    <li><a href="https://www.oreilly.com/library/view/learning-sql-3rd/9781492057604/">SQL in 10 Minutes, Sams Teach Yourself</a></li>
                    <li><a href="https://www.oreilly.com/library/view/learning-sql-3rd/9781492057604/">SQL Cookbook</a></li>
                    <li><a href="https://www.oreilly.com/library/view/learning-sql-3rd/9781492057604/">The Art of SQL</a></li>
                </ul>
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
                <p>Cette requête SQL va sélectionner <code>SELECT</code> le champ <code>nom_du_champ</code> provenant <code>FROM</code> du tableau appelé <code>nom_du_tableau</code>.</p>
                <p>Le SQL, ou Structured Query Language, est un langage utilisé pour interagir avec les bases de données. La commande <code>SELECT</code> est l'une des commandes fondamentales de SQL et est utilisée pour récupérer des données à partir d'une ou plusieurs tables de base de données.</p>
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
                <p>L'usage de la commande <code>SELECT</code> en SQL permet de récupérer toutes les données d'une ou plusieurs colonnes. Cependant, cette commande peut entraîner l'affichage de lignes en doublon. Pour prévenir ces redondances dans les résultats, il suffit d'ajouter <code>DISTINCT</code> après <code>SELECT</code>.</p>
                <br>
                <p>La commande de base consiste à exécuter la requête suivante :</p>
                <p class="sql-command">SELECT DISTINCT ma_colonne FROM nom_du_tableau</p>
                <p>Cette requête récupère le champ <code>ma_colonne</code> de la table <code>nom_du_tableau</code> tout en évitant de renvoyer des doublons.</p>

                <h2>Exemple</h2>
                <p>Prenons le cas concret d’une table <code>client</code> qui contient des noms et prénoms:</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>identifiant</th>
                                <th>prenom</th>
                                <th>nom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pierre</td>
                                <td>Dupond</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sabrina</td>
                                <td>Bernard</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>David</td>
                                <td>Durand</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Pierre</td>
                                <td>Leroy</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Marie</td>
                                <td>Leroy</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p>En utilisant seulement <code>SELECT</code> tous les noms sont retournés, or la table contient plusieurs fois le même prénom (cf. Pierre). Pour sélectionner uniquement les prénoms uniques il faut utiliser la requête suivante:</p>
                <p class="sql-command">SELECT DISTINCT prenom FROM client</p>
                <p>Cette requête va retourner les champs suivants:</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>prenom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pierre</td>
                            </tr>
                            <tr>
                                <td>Sabrina</td>
                            </tr>
                            <tr>
                                <td>David</td>
                            </tr>
                            <tr>
                                <td>Marie</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p>Ce résultat affiche volontairement qu’une seule fois le prénom “Pierre” grâce à l’utilisation de la commande <code>DISTINCT</code> qui n’affiche que les résultats distincts.</p>
            </article>`;
                    break;

                case 'WHERE':
                    contentElement.innerHTML = `
            <article id="post-11" class="post-11 page type-page status-publish hentry">
                <h1>WHERE</h1>
                <p>La clause <code>WHERE</code> dans une requête SQL sert à filtrer les lignes d'une base de données en fonction d'une condition spécifique. Elle permet ainsi de sélectionner uniquement les données qui répondent à ce critère, facilitant ainsi l'obtention des informations souhaitées.</p>
                <h2>Syntaxe</h2>
                <p>La commande <code>WHERE</code> s’utilise en complément à une requête utilisant <code>SELECT</code>. La façon la plus simple de l’utiliser est la suivante:</p>
                <p class="sql-command">SELECT nom_colonnes FROM nom_table WHERE condition</p>
                <h2>Exemple</h2>
                <p>Imaginons une base de données appelée “client” qui contient le nom des clients, le nombre de commandes qu’ils ont effectués et leur ville:</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nom</th>
                                <th>nbr_commande</th>
                                <th>ville</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Paul</td>
                                <td>3</td>
                                <td>paris</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Maurice</td>
                                <td>0</td>
                                <td>rennes</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Joséphine</td>
                                <td>1</td>
                                <td>toulouse</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Gérard</td>
                                <td>7</td>
                                <td>paris</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p>Pour obtenir seulement la liste des clients qui habitent à Paris, il faut effectuer la requête suivante:</p>
                <p class="sql-command">SELECT * FROM client WHERE ville = 'paris'</p>
                <p>Cette requête retourne le résultat suivant:</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nom</th>
                                <th>nbr_commande</th>
                                <th>ville</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Paul</td>
                                <td>3</td>
                                <td>paris</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Gérard</td>
                                <td>7</td>
                                <td>paris</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>`;
                    break;

                case 'AND & OR':
                    contentElement.innerHTML = `
            <article id="post-11" class="post-11 page type-page status-publish hentry">
                <h1>AND & OR</h1>
                <p>Une requête SQL peut être restreinte à l’aide de la condition <code>WHERE</code>. Les opérateurs logiques <code>AND</code> et <code>OR</code> peuvent être utilisés au sein de la commande <code>WHERE</code> pour combiner des conditions.</p>
                <h2>Syntaxe d’utilisation des opérateurs AND et OR</h2>
                <p>Les opérateurs sont à ajoutés dans la condition <code>WHERE</code>. Ils peuvent être combinés à l’infini pour filtrer les données comme souhaité.</p>
                <p>L’opérateur <code>AND</code> permet de s’assurer que la <strong>condition1</strong> <code>ET</code> la <strong>condition2</strong> sont vraies :</p>
                <p class="sql-command">SELECT nom_colonnes FROM nom_table WHERE condition1 AND condition2</p>
                <p>L’opérateur <code>OR</code> vérifie quant à lui que la <strong>condition1</strong> <code>OU</code> la <strong>condition2</strong> est vraie :</p>
                <p class="sql-command">SELECT nom_colonnes FROM nom_table WHERE condition1 OR condition2</p>
                <p>Ces opérateurs peuvent être combinés à l’infini et mélangés. L’exemple ci-dessous filtre les résultats de la table <code>nom_table</code> si <strong>condition1</strong> <code>ET</code> <strong>condition2</strong> <code>OU</code> <strong>condition3</strong> est vraie :</p>
                <p class="sql-command">SELECT nom_colonnes FROM nom_table WHERE condition1 AND (condition2 OR condition3)</p>
            </article>`;
                    break;

                case 'IN':
                    contentElement.innerHTML = `
                        <article id="post-11" class="post-11 page type-page status-publish hentry">
                            <h1>IN</h1>
                            <p>L’opérateur logique <code>IN</code> dans SQL s’utilise avec la commande <code>WHERE</code> pour vérifier si une colonne est égale à l'une des valeurs comprises dans un ensemble de valeurs déterminées. C’est une méthode simple pour vérifier si une colonne est égale à une valeur OU une autre valeur OU une autre valeur et ainsi de suite, sans avoir à utiliser de multiples fois l’opérateur <code>OR</code>.</p>
                            <h2>Syntaxe</h2>
                            <p>Pour chercher toutes les lignes où la colonne <code>nom_colonne</code> est égale à ‘valeur1’ OU ‘valeur2’ ou ‘valeur3’, il est possible d’utiliser la syntaxe suivante:</p>
                            <p class="sql-command">SELECT nom_colonne FROM table WHERE nom_colonne IN (valeur1, valeur2, valeur3, ...)</p>
                            <p>A savoir : entre les parenthèses il n’y a pas de limite du nombre d’arguments. Il est possible d’ajouter encore d’autres valeurs.</p>
                            <p>Cette syntaxe peut être associée à l’opérateur <code>NOT</code> pour rechercher toutes les lignes qui ne sont pas égales à l’une des valeurs stipulées.</p>
                        
                            <p>Simplicité de l’opérateur <code>IN</code> La syntaxe utilisée avec l’opérateur est plus simple que d’utiliser une succession d’opérateur <code>OR</code>. Pour le montrer concrètement avec un exemple, voici 2 requêtes qui retournerons les mêmes résultats, l’une utilise l’opérateur <code>IN</code>, tandis que l’autre utilise plusieurs <code>OR</code>.</p>
                            <p>Requête avec plusieurs <code>OR</code> :</p>
                            <p class="sql-command">SELECT prenom FROM utilisateur WHERE prenom = 'Maurice' OR prenom = 'Marie' OR prenom = 'Thimoté'</p>
                            <p>Requête équivalent avec l’opérateur <code>IN</code> :</p>
                            <p class="sql-command">SELECT prenom FROM utilisateur WHERE prenom IN ('Maurice', 'Marie', 'Thimoté')</p>
                        </article>`;
                    break;

                case 'BETWEEN':
                    contentElement.innerHTML = `
        <article id="post-11" class="post-11 page type-page status-publish hentry">
            <h1>BETWEEN</h1>
            <p>L'opérateur <code>BETWEEN</code> en SQL est utilisé pour sélectionner des valeurs dans une plage donnée. Il est souvent utilisé avec la clause <code>WHERE</code> pour filtrer les résultats en fonction de certaines conditions de plage.</p>
            <h2>Syntaxe</h2>
            <p>La syntaxe générale de l'opérateur <code>BETWEEN</code> est la suivante :</p>
            <p class="sql-command">SELECT colonne FROM table WHERE colonne BETWEEN valeur1 AND valeur2</p>
            <h2>Exemple</h2>
            <p>Supposons que nous avons une table <code>produits</code> avec une colonne <code>prix</code> et nous voulons sélectionner tous les produits dont le prix est compris entre 10 et 50 euros :</p>
            <p class="sql-command">SELECT * FROM produits WHERE prix BETWEEN 10 AND 50</p>
            <p>Cette requête retournera tous les produits dont le prix est compris entre 10 et 50 euros, y compris les produits dont le prix est exactement 10 ou 50.</p>
            <h2>Exemple : filtrer entre 2 dates</h2>
<p>Imaginons une table <code>utilisateur</code> qui contient les membres d’une application en ligne :</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>nom</th>
            <th>date_inscription</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Maurice</td>
            <td>2012-03-02</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Simon</td>
            <td>2012-03-05</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Chloé</td>
            <td>2012-04-14</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Marie</td>
            <td>2012-04-15</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Clémentine</td>
            <td>2012-04-26</td>
        </tr>
    </tbody>
</table>
<p>Si l'on souhaite obtenir les membres qui se sont inscrits entre le 1 avril 2012 et le 20 avril 2012, il est possible d'effectuer la requête suivante :</p>
<p class="sql-command">SELECT * FROM utilisateur WHERE date_inscription BETWEEN '2012-04-01' AND '2012-04-20'</p>
<p>Résultat :</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>nom</th>
            <th>date_inscription</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>3</td>
            <td>Chloé</td>
            <td>2012-04-14</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Marie</td>
            <td>2012-04-15</td>
        </tr>
    </tbody>
</table>
        </article>`;
                    break;
                case 'LIKE':
                    contentElement.innerHTML = `<article id="post-11" class="post-11 page type-page status-publish hentry">
    <h1>LIKE</h1>
    <p>L'opérateur <code>LIKE</code> est un élément de la clause <code>WHERE</code> utilisé dans les requêtes SQL. Il permet de rechercher des données basées sur un modèle spécifique. Par exemple, on peut rechercher des enregistrements où la valeur d'une colonne commence par une lettre spécifique. Les modèles de recherche peuvent être variés.</p>
    <h2>Syntaxe</h2>
    <p>La syntaxe à utiliser pour utiliser l'opérateur LIKE est la suivante :</p>
    <pre><code>SELECT *
FROM table
WHERE colonne LIKE modele</code></pre>
    <p>Dans cet exemple, le "modèle" n'a pas été défini, mais il ressemble très généralement à l'un des exemples suivants :</p>
    <ul>
        <li><code>LIKE '%a'</code> : le caractère "%" est un caractère joker qui remplace tous les autres caractères. Ainsi, ce modèle permet de rechercher toutes les chaînes de caractères qui se terminent par un "a".</li>
        <li><code>LIKE 'a%'</code> : ce modèle permet de rechercher toutes les lignes de "colonne" qui commencent par un "a".</li>
        <li><code>LIKE '%a%'</code> : ce modèle est utilisé pour rechercher tous les enregistrements qui utilisent le caractère "a".</li>
        <li><code>LIKE 'pa%on'</code> : ce modèle permet de rechercher les chaînes qui commencent par "pa" et qui se terminent par "on", comme "pantalon" ou "pardon".</li>
        <li><code>LIKE 'a_c'</code> : peu utilisé, le caractère "_" (underscore) peut être remplacé par n'importe quel caractère, mais un seul caractère uniquement (alors que le symbole pourcentage "%" peut être remplacé par un nombre incalculable de caractères). Ainsi, ce modèle permet de retourner les lignes "aac", "abc" ou même "azc".</li>
    </ul>
</article>
`;
                    break;
                case 'GROUP BY':
                    contentElement.innerHTML = `<article id="post-11" class="post-11 page type-page status-publish hentry">
    <h1>GROUP BY</h1>
    <p>La commande GROUP BY est utilisée en SQL pour grouper plusieurs résultats et utiliser une fonction de totaux sur un groupe de résultat. Sur une table qui contient toutes les ventes d’un magasin, il est par exemple possible de regrouper les ventes par clients identiques et d’obtenir le coût total des achats pour chaque client.</p>
    <h2>Syntaxe d’utilisation de GROUP BY</h2>
    <p>De façon générale, la commande GROUP BY s’utilise de la façon suivante :</p>
    <pre><code>SELECT colonne1, fonction(colonne2)
FROM table
GROUP BY colonne1
</code></pre>
    <p><strong>A noter :</strong> cette commande doit toujours s’utiliser après la commande WHERE et avant la commande HAVING.</p>
    <h2>Exemple d’utilisation</h2>
    <p>Prenons en considération une table “achat” qui résume les ventes d’une boutique :</p>
    <pre><code>id  client  tarif  date
1   Pierre  102    2012-10-23
2   Simon   47     2012-10-27
3   Marie   18     2012-11-05
4   Marie   20     2012-11-14
5   Pierre  160    2012-12-03
</code></pre>
    <p>Ce tableau contient une colonne qui sert d’identifiant pour chaque ligne, une autre qui contient le nom du client, le coût de la vente et la date d’achat.</p>
    <p>Pour obtenir le coût total de chaque client en regroupant les commandes des mêmes clients, il faut utiliser la requête suivante :</p>
    <pre><code>SELECT client, SUM(tarif)
FROM achat
GROUP BY client
</code></pre>
    <p>La fonction SUM() permet d’additionner la valeur de chaque tarif pour un même client. Le résultat sera donc le suivant :</p>
    <pre><code>client  SUM(tarif)
Pierre  262
Simon   47
Marie   38
</code></pre>
    <p>La manière simple de comprendre le GROUP BY c’est tout simplement d’assimiler qu’il va éviter de présenter plusieurs fois les mêmes lignes. C’est une méthode pour éviter les doublons.</p>
</article>
`;
                    break;
                case 'HAVING':
                    contentElement.innerHTML = `<article id="post-11" class="post-11 page type-page status-publish hentry">
    <h1>HAVING</h1>
    <p>La condition HAVING en SQL est presque similaire à WHERE à la seule différence que HAVING permet de filtrer en utilisant des fonctions telles que SUM(), COUNT(), AVG(), MIN() ou MAX().</p>
    <h2>Syntaxe</h2>
    <p>L’utilisation de HAVING s’utilise de la manière suivante :</p>
    <pre><code>SELECT colonne1, SUM(colonne2)
FROM nom_table
GROUP BY colonne1
HAVING fonction(colonne2) operateur valeur
</code></pre>
    <p>Cela permet donc de SÉLECTIONNER les colonnes DE la table “nom_table” en GROUPANT les lignes qui ont des valeurs identiques sur la colonne “colonne1” et que la condition de HAVING soit respectée.</p>
    <p><strong>Important :</strong> HAVING est très souvent utilisé en même temps que GROUP BY bien que ce ne soit pas obligatoire.</p>
    <h2>Exemple</h2>
    <p>Pour utiliser un exemple concret, imaginons une table “achat” qui contient les achats de différents clients avec le coût du panier pour chaque achat.</p>
    <pre><code>id  client  tarif  date_achat
1   Pierre  102    2012-10-23
2   Simon   47     2012-10-27
3   Marie   18     2012-11-05
4   Marie   20     2012-11-14
5   Pierre  160    2012-12-03
</code></pre>
    <p>Si dans cette table on souhaite récupérer la liste des clients qui ont commandé plus de 40€, toute commandes confondu alors il est possible d’utiliser la requête suivante :</p>
    <pre><code>SELECT client, SUM(tarif)
FROM achat
GROUP BY client
HAVING SUM(tarif) &gt; 40
</code></pre>
    <p>Résultat :</p>
    <pre><code>client  SUM(tarif)
Pierre  262
Simon   47
</code></pre>
    <p>La cliente “Marie” a cumulé 38€ d’achat (un achat de 18€ et un autre de 20€) ce qui est inférieur à la limite de 40€ imposée par HAVING. En conséquent cette ligne n’est pas affichée dans le résultat.</p>
</article>`;
                    break;
                case 'JOINTURE':
                    contentElement.innerHTML = `<article id="post-11" class="post-11 page type-page status-publish hentry">
    <h1>Jointure</h1>
    <p>Les jointures en SQL permettent d’associer plusieurs tables dans une même requête. Cela permet d’exploiter la puissance des bases de données relationnelles pour obtenir des résultats qui combinent les données de plusieurs tables de manière efficace.</p>
    <h2>Exemple</h2>
    <p>En général, les jointures consistent à associer des lignes de 2 tables en associant l’égalité des valeurs d’une colonne d’une première table par rapport à la valeur d’une colonne d’une seconde table. Imaginons qu’une base de données possède une table “utilisateur” et une autre table “adresse” qui contient les adresses de ces utilisateurs. Avec une jointure, il est possible d’obtenir les données de l’utilisateur et de son adresse en une seule requête.</p>
    <p>On peut aussi imaginer qu’un site web possède une table pour les articles (titre, contenu, date de publication …) et une autre pour les rédacteurs (nom, date d’inscription, date de naissance …). Avec une jointure il est possible d’effectuer une seule recherche pour afficher un article et le nom du rédacteur. Cela évite d’avoir à afficher le nom du rédacteur dans la table “article”.</p>
    <p>Il y a d’autres cas de jointures, incluant des jointures sur la même table ou des jointures d’inégalité. Ces cas étant assez particuliers et pas si simples à comprendre, ils ne seront pas élaborés sur cette page.</p>
    <h2>Types de jointures</h2>
    <p>Il y a plusieurs méthodes pour associer 2 tables ensemble. Voici la liste des différentes techniques qui sont utilisées :</p>
    <ul>
        <li>INNER JOIN : jointure interne pour retourner les enregistrements quand la condition est vraie dans les 2 tables. C’est l’une des jointures les plus communes.</li>
        <li>CROSS JOIN : jointure croisée permettant de faire le produit cartésien de 2 tables. En d’autres mots, permet de joindre chaque ligne d’une table avec chaque ligne d’une seconde table. Attention, le nombre de résultats est en général très élevé.</li>
        <li>LEFT JOIN (ou LEFT OUTER JOIN) : jointure externe pour retourner tous les enregistrements de la table de gauche (LEFT = gauche) même si la condition n’est pas vérifiée dans l’autre table.</li>
        <li>RIGHT JOIN (ou RIGHT OUTER JOIN) : jointure externe pour retourner tous les enregistrements de la table de droite (RIGHT = droite) même si la condition n’est pas vérifiée dans l’autre table.</li>
        <li>FULL JOIN (ou FULL OUTER JOIN) : jointure externe pour retourner les résultats quand la condition est vraie dans au moins une des 2 tables.</li>
        <li>SELF JOIN : permet d’effectuer une jointure d’une table avec elle-même comme si c’était une autre table.</li>
        <li>NATURAL JOIN : jointure naturelle entre 2 tables s’il y a au moins une colonne qui porte le même nom entre les 2 tables SQL.</li>
        <li>UNION JOIN : jointure d’union.</li>
    </ul>
</article>
`;
                    break;
                case 'AGGRAGATIONS':
                    contentElement.innerHTML = `<article id="post-11" class="post-11 page type-page status-publish hentry">
    <h1>Aggregations</h1>
    <p>Les fonctions d’agrégation dans le langage SQL permettent d’effectuer des opérations statistiques sur un ensemble d’enregistrements. Étant données que ces fonctions s’appliquent à plusieurs lignes en même temps, elles permettent des opérations qui servent à récupérer l’enregistrement le plus petit, le plus grand ou bien encore de déterminer la valeur moyenne sur plusieurs enregistrements.</p>
    <h2>Liste des fonctions d’agrégation statistiques</h2>
    <p>Les fonctions d’agrégation sont des fonctions idéales pour effectuer quelques statistiques de bases sur des tables. Les principales fonctions sont les suivantes :</p>
    <ul>
        <li><strong>AVG()</strong> pour calculer la moyenne sur un ensemble d’enregistrements</li>
        <li><strong>COUNT()</strong> pour compter le nombre d’enregistrements sur une table ou une colonne distincte</li>
        <li><strong>MAX()</strong> pour récupérer la valeur maximum d’une colonne sur un ensemble de lignes. Cela s’applique à la fois pour des données numériques ou alphanumériques</li>
        <li><strong>MIN()</strong> pour récupérer la valeur minimum de la même manière que MAX()</li>
        <li><strong>SUM()</strong> pour calculer la somme sur un ensemble d’enregistrements</li>
    </ul>
    <h2>Utilisation simple</h2>
    <p>L’utilisation la plus générale consiste à utiliser la syntaxe suivante : La fonction COUNT() possède une subtilité. Pour compter le nombre total de lignes d’une table, il convient d’utiliser l’étoile “*” qui signifie que l’on cherche à compter le nombre d’enregistrements sur toutes les colonnes. La syntaxe serait alors la suivante :</p>
    <pre><code>SELECT COUNT(*) FROM table</code></pre>
    <h2>Utilisation avec GROUP BY</h2>
    <p>Toutes ces fonctions prennent tout leur sens lorsqu’elles sont utilisées avec la commande GROUP BY qui permet de filtrer les données sur une ou plusieurs colonnes. Imaginons une table qui contient tous les achats sur un site avec le montant de chaque achat pour chaque enregistrement. Pour obtenir le total des ventes par clients, il est possible d’exécuter la requête suivante :</p>
    <pre><code>SELECT client, SUM(tarif)
 FROM achat
 GROUP BY client</code></pre>
</article>
`;
                    break;
                default:
                    contentElement.innerHTML = '<article id="post-11" class="post-11 page type-page status-publish hentry"><p>Sélectionnez une catégorie pour afficher le contenu correspondant.</p></article>';
            }

        }
    </script>
</body>

</html>