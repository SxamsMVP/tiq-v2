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
// Initialisation ou récupération de l'index de question de l'utilisateur
$questionIndex = isset($_SESSION['question_index']) ? $_SESSION['question_index'] : 0;

// Récupérer la question en fonction de l'index de question de l'utilisateur sans tenir compte du niveau
$resultat = $bdd->query("SELECT * FROM questions ORDER BY id LIMIT $questionIndex, 1");
$currentQuestion = $resultat->fetchArray(SQLITE3_ASSOC);

if (!$currentQuestion) {
    // Si aucune question trouvée, rediriger vers une page d'erreur ou revenir à la première question
    header("Location: error.php");
    exit;
}

$pathUML = $currentQuestion['path_uml'];

if (isset($_POST['previous'])) {
    // Décrémenter l'index de question pour afficher la question précédente
    $_SESSION['question_index'] = max($_SESSION['question_index'] - 1, 0);
    header("Location: exercices.php");
    exit;
}

// Fonction pour comparer les résultats des requêtes SQL
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

        if (!$isAnswerCorrect) {
            $_SESSION['incorrect_attempts']++;
        } else {
            // Réinitialiser les tentatives incorrectes et passer à la question suivante
            $_SESSION['incorrect_attempts'] = 0;
    header("Location: exercices.php");

            exit;
        }
    }
}

if (isset($_POST['nextQuestion'])) {
    if (isset($_SESSION['question_index'])) {
        $_SESSION['question_index']++;
        // Mise à jour de l'index de la question dans la base de données pour l'utilisateur connecté
        $newIndex = $_SESSION['question_index'];
        $username = $_SESSION['username']; // Assurez-vous que le nom d'utilisateur est bien stocké dans la session
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            // Gérer l'absence de l'ID, par exemple, en définissant une valeur par défaut ou en gérant une erreur
            $id = 0; // Ou toute autre gestion d'erreur appropriée
        }
        
        $updateQuery = "UPDATE utilisateurs SET question = :newIndex WHERE id = :id";
        $stmt = $bdd->prepare($updateQuery);
        $stmt->bindValue(':newIndex', $newIndex, SQLITE3_INTEGER);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->execute();
    }
    header("Location: exercices.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<!-- Le reste du code HTML reste inchangé -->

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
                    <?php if ($_SESSION['incorrect_attempts'] >= 3 || (isset($_SESSION['isAnswerCorrect']) && $_SESSION['isAnswerCorrect'])) : ?>
                        <button type="button" id="nextQuestion" class="btn btn-success">Question suivante</button>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
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
                            <?php $_SESSION['incorrect_attempts'] = 0; // Réinitialiser le compteur après avoir affiché le message 
                            ?>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['isAnswerCorrect']) && $_SESSION['isAnswerCorrect']) : ?>
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

            function goToNextQuestion() {
                var form = document.createElement('form');
                document.body.appendChild(form);
                form.method = 'POST';
                form.action = 'exercices.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'nextQuestion';
                form.appendChild(input);
                form.submit();
            }
        </script>
        <script>
            <?php if ($_SESSION['incorrect_attempts'] >= 3) : ?>
                var errorMessage = "<?php echo "<div class='alert alert-info'>La réponse correcte était : <br>" . htmlspecialchars($currentQuestion['reponse']) . "</div>"; ?>";
                $('#resultModal .modal-body').html(errorMessage);
                $('#resultModal').modal('show');
                <?php $_SESSION['incorrect_attempts'] = 0; // Réinitialiser le compteur après avoir affiché le message 
                ?>
            <?php endif; ?>
        </script>
</body>

</html>