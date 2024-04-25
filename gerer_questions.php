<?php
session_start();
include('header.php');
// Connect to SQLite Database
$bdd = new SQLite3('database.sqlite');

// Arrays to hold questions from each table
$parcours_questions = [];
$select_questions = [];
$where_questions = [];
$join_questions = [];
$having_questions = [];
$groupeby_questions = [];
$aggregation_questions = [];

// Fetch questions from each table
$tables = ['parcours_questions', 'select_questions', 'where_questions', 'join_questions', 'having_questions', 'groupeby_questions', 'aggregation_questions'];
foreach ($tables as $table) {
    $sql = "SELECT * FROM $table";
    $result = $bdd->query($sql);
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        switch ($table) {
            case 'parcours_questions':
                $parcours_questions[] = $row;
                break;
            case 'select_questions':
                $select_questions[] = $row;
                break;
            case 'where_questions':
                $where_questions[] = $row;
                break;
            case 'join_questions':
                $join_questions[] = $row;
                break;
            case 'having_questions':
                $having_questions[] = $row;
                break;
            case 'groupeby_questions':
                $groupeby_questions[] = $row;
                break;
            case 'aggregation_questions':
                $aggregation_questions[] = $row;
                break;
        }
    }
}
$bdd->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CHALLENGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/header_menu.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/gerer_questions.css">
    <style>
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

    <div class="questions-menu mt-4">
        <a href="javascript:void(0);" onclick="showQuestions('parcours')" class="question-link link-parcours">Parcours Questions</a>
        <a href="javascript:void(0);" onclick="showQuestions('select')" class="question-link link-select">Select Questions</a>
        <a href="javascript:void(0);" onclick="showQuestions('where')" class="question-link link-where">Where Questions</a>
        <a href="javascript:void(0);" onclick="showQuestions('having')" class="question-link link-parcours">Having Questions</a>
        <a href="javascript:void(0);" onclick="showQuestions('join')" class="question-link link-select">Join Questions</a>
        <a href="javascript:void(0);" onclick="showQuestions('groupeby')" class="question-link link-where">Groupe By Questions</a>
        <a href="javascript:void(0);" onclick="showQuestions('aggregation')" class="question-link link-parcours">Aggregation Questions</a>
    </div>

    <div class="container mt-1">
        <?php foreach (['parcours' => $parcours_questions, 'select' => $select_questions, 'where' => $where_questions, 'having' => $having_questions, 'join' => $join_questions, 'groupeby' => $groupeby_questions, 'aggregation' => $aggregation_questions] as $type => $questions) : ?>
            <div id="<?= $type ?>" class="question-set" style="display: none;">
                <h1 class="mb-3"><?= ucfirst($type) ?> Questions</h1>
                <ul class="list-group">
                    <?php foreach ($questions as $question) : ?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 text-left text-warning">Question <?= htmlspecialchars($question['question']) ?></p>
                                    <p class="mb-1 text-left text-info">Réponse <?= htmlspecialchars($question['reponse']) ?></p>
                                    <?php if (!empty($question['path_uml'])) : ?>
                                        <p><img src="<?= htmlspecialchars($question['path_uml']) ?>" alt="UML Diagram" style="max-width:100%;"></p>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <form action="modifier_questions.php" method="post" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $question['id'] ?>">
                                        <input type="hidden" name="table" value="<?= $type ?>">
                                        <button type="submit" class="btn-edit">Modifier</button>
                                    </form>
                                    <form action="suppr_questions.php" method="post" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $question['id'] ?>">
                                        <input type="hidden" name="table" value="<?= $type ?>">
                                        <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        function showQuestions(type) {
            document.querySelectorAll('.question-set').forEach(div => div.style.display = 'none');
            document.getElementById(type).style.display = 'block';
        }
        // Initially display the first set
        showQuestions('parcours');
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>