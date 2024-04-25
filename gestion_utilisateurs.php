<?php
session_start();
include('header.php');
// Connexion à la base de données SQLite
$bdd = new SQLite3('database.sqlite');

// Vérification de la connexion
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}

// Vérification si un utilisateur est à supprimer
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $idToDelete = $_GET['delete'];

    // Suppression de l'utilisateur avec l'ID spécifié
    $queryDelete = "DELETE FROM utilisateurs WHERE id = :id";
    $statementDelete = $bdd->prepare($queryDelete);
    $statementDelete->bindValue(':id', $idToDelete, SQLITE3_INTEGER);
    $statementDelete->execute();
}

// Récupération de tous les utilisateurs
$querySelect = "SELECT * FROM utilisateurs";
$resultSelect = $bdd->query($querySelect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CHALLENGER</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="style/gestion_utilisateurs.css">
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
                echo '<a  style="font-weight: bold; font-size: 1.2em;" href="account.php">' . $username . '</a>';
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
        <a href="accueil_exercice.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>
    <div class="container mx-auto mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Liste des utilisateurs</h2>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>Username</th>
                            <th>Photo</th>
                            <th>Admin</th>
                            <th>Niveau Parcours</th>
                            <th>Niveau Selection</th>
                            <th>Niveau Where</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $resultSelect->fetchArray()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['prenom'] . "</td>";
                            echo "<td>" . $row['nom'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['adresse'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td><img src='" . $row['photo_path'] . "' alt='Photo de profil' style='max-width: 100px; max-height: 100px;'></td>";
                            echo "<td>" . $row['admin'] . "</td>";
                            echo "<td>" . $row['question'] . "</td>";
                            echo "<td>" . $row['select_question_index'] . "</td>";
                            echo "<td>" . $row['where_question_index'] . "</td>";
                            echo "<td><a href='gestion_utilisateurs.php?delete=" . $row['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Fermeture de la connexion -->
    <?php $bdd->close(); ?>
</body>

</html>

