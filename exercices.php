<?php
session_start();
include('header.php');

$bdd = new SQLite3('database.sqlite');
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}

if (!isset($_SESSION['incorrect_attempts'])) {
    $_SESSION['incorrect_attempts'] = 0;
}

// Initialisation ou récupération du niveau de l'utilisateur
$userLevel = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : 1;

// Choisir une nouvelle question si nécessaire
if (!isset($_SESSION['currentQuestion'])) {
    $resultat = $bdd->query("SELECT * FROM questions WHERE level <= $userLevel ORDER BY RANDOM() LIMIT 1");
    $_SESSION['currentQuestion'] = $resultat->fetchArray(SQLITE3_ASSOC);
}
$currentQuestion = $_SESSION['currentQuestion'];


$pathUML = $currentQuestion['path_uml'];

if (isset($_POST['previous'])) {
    $_SESSION['question_index'] = max($_SESSION['question_index'] - 1, 0); // S'assurer que l'index ne devient pas négatif
    header("Location: exercices.php");
    exit;
}
function compareResults($result1, $result2)
{
    $array1 = [];
    while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
        $array1[] = $row;
    }
    $array2 = [];
    while ($row = $result2->fetchArray(SQLITE3_ASSOC)) {
        $array2[] = $row;
    }
    return $array1 === $array2;
}

$isAnswerCorrect = false;
$userResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql_query = $_POST['sql_query'] ?? '';
    
        $userResult = $bdd->query($sql_query);

    if (isset($_POST['validate']) && $currentQuestion) {
        $answer = $currentQuestion['reponse'];
        $answerResult = $bdd->query($answer);
        if ($userResult && $answerResult) {
            $isAnswerCorrect = compareResults($userResult, $answerResult);
            $_SESSION['isAnswerCorrect'] = $isAnswerCorrect;
        }
    } // Mise à jour du compteur de tentatives incorrectes
    if (!$isAnswerCorrect) {
        $_SESSION['incorrect_attempts']++;
        if ($_SESSION['incorrect_attempts'] >= 3) {
            // Ici, vous pouvez gérer l'affichage du message après 3 tentatives incorrectes
        }
    } else {
        $_SESSION['incorrect_attempts'] = 0; // Réinitialiser le compteur si la réponse est correcte
    }
}
if ($isAnswerCorrect) {
    header("Location: exercices.php"); // Redirection
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CHALLENGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/exercices.css">
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

    <!-- Menu horizontal -->
    <div class="menu">
        <a href="cours.php">Cours</a>
        <a href="exercices.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>
    <div class="container mt-2">
        <?php if ($currentQuestion) : ?>
            <h3 class="mb-3"><strong>Question:</strong> <?php echo $currentQuestion['question']; ?></h3>
        <?php endif; ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-6">
                    <h4>Entrez votre requête SQL :</h4>
                    <form id="sqlForm" action="exercices.php" method="post">
                        <div class="form-group">
                            <textarea name="sql_query" id="sql_query" rows="8" cols="50" class="form-control" required><?php echo isset($_POST['sql_query']) ? htmlspecialchars($_POST['sql_query']) : ''; ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" id="executeQuery" class="btn btn-primary w-50">Exécuter la requête</button>
                            <?php if ($currentQuestion) : ?>
                                <button type="submit" class="btn btn-success w-50 ml-2" name="validate">Valider</button>
                            <?php endif; ?>
                        </div>
                    </form>
                    <button type="button" id="previousQuestion" class="btn btn-secondary">Question précédente</button>

                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <h4>UML :</h4>
                    </div>
                    <div class="text-center">
                        <img src="<?php echo $currentQuestion['path_uml']; ?>" alt="Image UML" class="img-fluid" style="max-width: 80%; height: auto;">
                    </div>

                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($userResult)) : ?>
                        <?php
                        $firstRow = true;
                        $hasResults = false;
                        $columnNames = [];
                        ?>
                        <h4>Résultats de la requête :</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <?php while ($row = $userResult->fetchArray(SQLITE3_ASSOC)) : ?>
                                            <?php $hasResults = true; ?> <!-- Marquer qu'il y a des résultats -->
                                            <?php if ($firstRow) : ?>
                                                <?php foreach ($row as $columnName => $value) : ?>
                                                    <th><?php echo $columnName; ?></th>
                                                    <?php $columnNames[] = $columnName; ?>
                                                <?php endforeach; ?>
                                                <?php $firstRow = false; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($row as $value) : ?>
                                            <td><?php echo $value; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <tr>
                                    <?php foreach ($columnNames as $columnName) : ?>
                                        <td><?php echo $row[$columnName]; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if (!$hasResults) : ?> <!-- Utiliser la nouvelle variable pour le contrôle -->
                            <p>Aucun résultat trouvé.</p>
                        <?php endif; ?>
                    <?php endif; ?>


                </div>
            </div>
        </div>

        <!-- Modal pour le résultat -->
        <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resultModalLabel">Résultat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Message sera inséré ici -->
                    </div>
                    <div class="modal-footer">
                        <?php if (isset($_SESSION['isAnswerCorrect']) && $_SESSION['isAnswerCorrect']) : ?>
                            <button type="button" class="btn btn-primary" id="nextQuestion">Question suivante</button>
                        <?php endif; ?>
                    </div>

                    <?php if ($_SESSION['incorrect_attempts'] >= 3) : ?>
                        <div class="alert alert-info">
                            La réponse correcte était : <br> <?php echo htmlspecialchars($currentQuestion['reponse']); ?>
                        </div>
                        <?php $_SESSION['incorrect_attempts'] = 0; // Réinitialisez le compteur après avoir affiché le message 
                        ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {
                <?php if (isset($_SESSION['isAnswerCorrect'])) : ?>
                    let isAnswerCorrect = <?php echo json_encode($_SESSION['isAnswerCorrect']); ?>;
                    $('#resultModal .modal-body').html(isAnswerCorrect ? 'Bonne réponse!' : 'Mauvaise réponse.');
                    $('#resultModal').modal('show');
                    <?php unset($_SESSION['isAnswerCorrect']); ?>
                <?php endif; ?>

                document.getElementById('executeQuery').addEventListener('click', function() {
                    document.getElementById('sqlForm').submit();
                });
                document.getElementById('nextQuestion').addEventListener('click', function() {
                    window.location.reload(); // Cela rafraîchira la page
                });
            });
            document.getElementById('previousQuestion').addEventListener('click', function() {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'exercices.php';

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'previous';
                input.value = '1';
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            });
        </script>
</body>

</html>