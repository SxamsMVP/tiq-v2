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
    <link rel="stylesheet" href="style/add_question.css">
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

    <!-- Menu horizontal -->
    <div class="menu">
        <a href="cours.php">Cours</a>
        <a href="accueil_exercice.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>

    <body>
    <div class="container">
        <h1>Ajouter une question</h1>
        <form action="traitement_question.php" method="post">
            <div class="form-group">
                <label for="question">Question :</label>
                <textarea name="question" required></textarea>
            </div>
            <div class="form-group">
                <label for="reponse">Réponse :</label>
                <textarea name="reponse" required></textarea>
            </div>
            <div class="form-group">
                <label for="table">Table à impacter:</label>
                <select name="table" required>
                    <option value="select_questions">Select</option>
                    <option value="where_questions">Where</option>
                    <option value="having_question">Having</option>
                    <option value="join_question">Join</option>
                    <option value="groupby_question">Group By</option>
                    <option value="aggregation_questions">Aggrégation</option>
                    <option value="parcours_questions">Parcours</option>
                </select>
            </div>
            <div class="form-group">
                <label for="imgpath">Image:</label>
                <select name="imgpath" required>
                    <option value="img/uml/uml_emp.png">Emp</option>
                    <option value="img/uml/uml_projets.JPG">Projets</option>
                    <option value="img/uml/uml_appartements.JPG">Appartements</option>
                    <option value="img/uml/uml_emp_test.JPG">Emp test</option>
                    <option value="img/uml/uml_vol.png">Vol</option>
                </select>
            </div>
            <input type="submit" value="Ajouter" class="btn-submit">
        </form>
    </div>
</body>
</html>