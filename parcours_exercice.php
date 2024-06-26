<?php
ob_start();
session_start();
include('header.php');
error_reporting(E_ALL & ~E_WARNING);
if (!isset($_SESSION['incorrect_attempts'])) {
    $_SESSION['incorrect_attempts'] = 0;
}

// Récupération de la question actuelle basée sur l'index
$resultat = $bdd->prepare("SELECT * FROM parcours_questions ORDER BY id LIMIT 1 OFFSET :questionIndex");
$resultat->bindValue(':questionIndex', $questionIndex - 1, SQLITE3_INTEGER);
$currentQuestion = $resultat->execute()->fetchArray(SQLITE3_ASSOC);
$pathUML = $currentQuestion['path_uml'];

if (!$currentQuestion) {
    header("Location: error.php");
    exit;
}

$isAnswerCorrect = false;
$userResult = null;
try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql_query = $_POST['sql_query'] ?? '';
        try {
            $userResult = $bdd->query($sql_query);
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Erreur de requête SQL : " . $e->getMessage();
            header("Location: error.php"); // Assurez-vous que cette page affiche les messages d'erreur.
            exit;
        }

        // Logique pour valider la réponse
        if (isset($_POST['validate']) && $currentQuestion) {
            $answer = $currentQuestion['reponse'];
            $answerResult = $bdd->query($answer);
            if ($userResult && $answerResult) {
                $isAnswerCorrect = compareResults($userResult, $answerResult);
                $_SESSION['isAnswerCorrect'] = $isAnswerCorrect;
            }

            if ($isAnswerCorrect) {
                $_SESSION['incorrect_attempts'] = 0;
            } else {
                $_SESSION['incorrect_attempts']++;
            }
        }
    }
} catch (Exception $e) {
    // Gestion générale des erreurs
    $_SESSION['error_message'] = "Erreur interne : " . $e->getMessage();
    header("Location: error.php");
    exit;
}

if (isset($_POST['nextQuestion'])) {
    $_SESSION['question_index']++;
    $newIndex = $_SESSION['question_index'];
    $userId = $_SESSION['user_id'];
    $updateQuery = $bdd->prepare("UPDATE utilisateurs SET question = :newIndex WHERE id = :userId");
    $updateQuery->bindValue(':newIndex', $newIndex, SQLITE3_INTEGER);
    $updateQuery->bindValue(':userId', $userId, SQLITE3_INTEGER);
    $updateQuery->execute();
    header("Location: parcours_exercice.php");
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

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CHALLENGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
    <div class="container mt-1 mb-2">
        <h4>Progression :</h4>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: <?php echo ($questionIndex / 40) * 100; ?>%;" aria-valuenow="<?php echo $questionIndex; ?>" aria-valuemin="0" aria-valuemax="40">
                <?php echo $questionIndex; ?>/40
            </div>
        </div>
        <?php if ($currentQuestion) : ?>
            <h3 class="mt-3 mb-3"><strong>Question n°<?php echo $questionIndex; ?> :</strong> <?php echo $currentQuestion['question']; ?></h3>
        <?php endif; ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-6">
                    <h4>Entrez votre requête SQL :</h4>
                    <form id="sqlForm" action="parcours_exercice.php" method="post">
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
                    <?php if ($_SESSION['incorrect_attempts'] >= 3 || (isset($_SESSION['isAnswerCorrect']) && $_SESSION['isAnswerCorrect'])) : ?>
                        <button type="button" id="nextQuestion" class="btn btn-success">Question suivante</button>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <div class="text-center mb-2">
                        <img src="<?php echo $currentQuestion['path_uml']; ?>" alt="Image UML" class="img-fluid" style="max-width: 80%; height: auto;">
                    </div>

                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                        <?php
                        $sql_query = $_POST['sql_query'] ?? '';
                        $userResult = $bdd->query($sql_query);
                        if (!$userResult) {
                            $errorInfo = $bdd->lastErrorMsg();
                            echo '<div class="alert alert-danger">Erreur lors de l\'exécution de la requête : ';
                            echo '<div class="alert alert-danger mt-3">' . htmlspecialchars($errorInfo) . '</div>';
                        } else {
                            $hasResults = false;
                            $columnNames = [];
                            $firstRow = true;
                        ?>
                            <h4>Résultats de la requête :</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <?php while ($row = $userResult->fetchArray(SQLITE3_ASSOC)) : ?>
                                                <?php $hasResults = true; ?>
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
                            <?php if (!$hasResults) : ?>
                                <p>Aucun résultat trouvé.</p>
                            <?php endif; ?>
                        <?php
                        }
                        ?>
                    <?php endif; ?>
                </div>


            </div>
        </div>
        <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered custom-modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header custom-modal-title">
                        <h5 class="modal-title" id="resultModalLabel">Résultat</h5>
                        <button type="button" class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <!-- Message sera inséré ici -->
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <?php if ($_SESSION['incorrect_attempts'] >= 3) : ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Oops!</strong> La réponse correcte était : <br> <?php echo htmlspecialchars($currentQuestion['reponse']); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php $_SESSION['incorrect_attempts'] = 0; ?>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['isAnswerCorrect']) && $_SESSION['isAnswerCorrect']) : ?>

                            <strong>A priori votre réponse est la bonne voici la réponse type attendue :</strong>
                            <span class="text-info font-weight-bold text-uppercase"><?= htmlspecialchars($currentQuestion['reponse']); ?></span>

                            <button type="button" class="btn btn-success" onclick="goToNextQuestion()">Question suivante</button>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {
                // Function to handle the display of the modal based on the correctness of the answer
                <?php if (isset($_SESSION['isAnswerCorrect'])) : ?>
                    let isAnswerCorrect = <?php echo json_encode($_SESSION['isAnswerCorrect']); ?>;
                    let message = isAnswerCorrect ? 'Bonne réponse!' : 'Mauvaise réponse.';
                    $('.modal-body').html(message); // Set the modal body content
                    $('#resultModal').modal('show'); // Show the modal
                    <?php unset($_SESSION['isAnswerCorrect']); ?> // Unset the session variable to avoid repeated messages
                <?php endif; ?>

                document.getElementById('executeQuery').addEventListener('click', function() {
                    document.getElementById('sqlForm').submit();
                });

                function goToNextQuestion() {
                    var form = document.createElement('form');
                    document.body.appendChild(form);
                    form.method = 'POST';
                    form.action = 'parcours_exercice.php';
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'nextQuestion';
                    form.appendChild(input);
                    form.submit();
                }
                window.goToNextQuestion = goToNextQuestion;

            });
        </script>

</body>

</html>