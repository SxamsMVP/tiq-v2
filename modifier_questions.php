<?php
session_start();
include('header.php');

// Récupération de la question
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['table'])) {
    $id = SQLite3::escapeString($_POST['id']);
    $table = SQLite3::escapeString($_POST['table']);
    // Correction des noms de table en fonction de l'entrée
    $valid_tables = [
        'select' => 'select_questions',
        'where' => 'where_questions',
        'parcours' => 'parcours_questions',
        'having' => 'having_questions',
        'groupby' => 'groupby_questions',
        'aggregation' => 'aggregation_questions',
        'join' => 'join_questions'
    ];

    if (array_key_exists($table, $valid_tables)) {
        $table = $valid_tables[$table];
        $sql = "SELECT * FROM $table WHERE id = '$id'";
        $result = $bdd->querySingle($sql, true);

        if ($result) {
            // Affichage du formulaire avec les données de la question
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Modifier Question - SQL CHALLENGER</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="style/header_menu.css">
                <link rel="stylesheet" href="style/add_question.css">
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        background-size: cover;
                        background-image: url('/img/add_question_background.png');
                        color: #333;
                    }

                    .center-title {
                        text-align: center;
                    }

                    .btn-delete {
                        background-color: #ff0000;
                        color: #fff;
                        border: none;
                        padding: 10px 15px;
                        border-radius: 5px;
                        cursor: pointer;
                        margin-top: 10px;
                    }

                    .btn-edit {
                        background-color: #0000FF;
                        color: #fff;
                        border: none;
                        padding: 10px 15px;
                        border-radius: 5px;
                        cursor: pointer;
                    }
                </style>
            </head>

            <body>
                <div class="header">
                    <div class="logo"><img src="img/logo.png" alt="Logo SQL CHALLENGER"></div>
                    <div class="header-title text-center"><a href="index.php" style="text-decoration: none; color: inherit;">SQL CHALLENGER</a></div>
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
                <div class="menu">
                    <a href="cours.php">Cours</a>
                    <a href="accueil_exercice.php">Exercices</a>
                    <a href="forum.php">Forum</a>
                </div>
                <div class="container mt-5">
                    <form action="submit_modification.php" method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                        <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
                        <div>
                            <label>Question</label>
                            <input type="text" name="question" value="<?= htmlspecialchars($result['question']) ?>" class="form-control">
                        </div>
                        <div>
                            <label class="mt-3">Réponse</label>
                            <textarea name="reponse" class="form-control"><?= htmlspecialchars($result['reponse']) ?></textarea>
                        </div>
                        <div>
                            <label class="mt-3">URL UML</label>
                            <textarea name="path_uml" class="form-control"><?= htmlspecialchars($result['path_uml']) ?></textarea>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </body>

            </html>
<?php
        } else {
            echo "<script>alert('Question non trouvée.'); window.location.href='gerer_questions.php';</script>";
        }
    } else {
        echo "<script>alert('Table spécifiée invalide.'); window.location.href='gerer_questions.php';</script>";
    }
} else {
    echo "<script>alert('Identifiant ou table non spécifiés.'); window.location.href='gerer_questions.php';</script>";
}
$bdd->close();
?>