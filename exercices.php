<?php
session_start();
include('header.php');
// Connexion à la base de données
$bdd = new SQLite3('database.sqlite');
// Vérification de la connexion
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}
// Récupération des questions depuis la base de données
$resultat = $bdd->query('SELECT * FROM questions');
// Stocker les questions dans une variable de session
$_SESSION['questions'] = [];
while ($row = $resultat->fetchArray(SQLITE3_ASSOC)) {
    $_SESSION['questions'][] = $row;
}
// Initialiser le compteur de question dans la session
if (!isset($_SESSION['question_index'])) {
    $_SESSION['question_index'] = 0;
}
// Récupérer le nom de la table à afficher depuis la base de données
$tableName = '';
$questionIndex = $_SESSION['question_index'];
if (isset($_SESSION['questions'][$questionIndex]['bdd'])) {
    $tableName = $_SESSION['questions'][$questionIndex]['bdd'];
}
// Récupérer les données de la table spécifiée
$tableData = [];
if (!empty($tableName)) {
    $tableExists = $bdd->querySingle("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='$tableName'");
    if ($tableExists) {
        $tableResult = $bdd->query("SELECT * FROM $tableName");
        while ($row = $tableResult->fetchArray(SQLITE3_ASSOC)) {
            $tableData[] = $row;
        }
    } else {
        // Afficher un message d'erreur explicite si la table n'existe pas
        echo "Erreur lors de l'exécution de la requête : La table $tableName n'existe pas.";
    }
}

// Récupérer la question actuelle
$currentQuestion = isset($_SESSION['questions'][$questionIndex]) ? $_SESSION['questions'][$questionIndex] : null;

// Exécuter la requête de l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql_query = $_POST['sql_query'] ?? '';

    // Exécuter la requête de l'utilisateur seulement si la table existe
    if ($tableExists) {
        $userResult = $bdd->query($sql_query);
    }

    // Exécuter la requête stockée dans le champ "answer"
    if ($currentQuestion) {
        $answer = $currentQuestion['reponse'];
        $answerResult = $bdd->query($answer);
    }
}

// Fonction pour comparer les résultats des requêtes
function compareResults($result1, $result2) {
    // Convertir les résultats en tableaux associatifs
    $array1 = [];
    while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
        $array1[] = $row;
    }

    $array2 = [];
    while ($row = $result2->fetchArray(SQLITE3_ASSOC)) {
        $array2[] = $row;
    }

    // Comparer les tableaux associatifs
    return $array1 === $array2;
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
                        <!-- Boutons dans le même formulaire pour les placer sur la même ligne -->
                        <div class="d-flex justify-content-between"> <!-- Utilisation de flexbox pour aligner les boutons -->
                            <button type="button" id="executeQuery" class="btn btn-primary w-50">Exécuter la requête</button>
                            <?php if ($currentQuestion) : ?>
                                <input type="hidden" name="answer" value="<?php echo isset($currentQuestion['answer']) ? htmlspecialchars($currentQuestion['answer']) : ''; ?>">
                                <button type="submit" class="btn btn-success w-50 ml-2" name="validate">Valider</button> <!-- Ajout de la classe ml-2 pour un espacement entre les boutons -->
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <?php if (!empty($tableName) && !empty($tableData)) : ?>
                        <div class="text-center">
                            <h4>Contenu de la table "<?php echo $tableName; ?>" :</h4>
                        </div>
                        <div class="table-responsive mb-5">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <?php foreach ($tableData[0] as $columnName => $value) : ?>
                                            <th><?php echo $columnName; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tableData as $row) : ?>
                                        <tr>
                                            <?php foreach ($row as $value) : ?>
                                                <td class="text-secondary"><?php echo $value; ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($userResult)) : ?>
                        <?php if ($userResult) : ?>
                            <h4>Résultats de la requête :</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <?php foreach ($userResult->fetchArray(SQLITE3_ASSOC) as $columnName => $value) : ?>
                                                <th><?php echo $columnName; ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $userResult->fetchArray(SQLITE3_ASSOC)) : ?>
                                            <tr>
                                                <?php foreach ($row as $value) : ?>
                                                    <td><?php echo $value; ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <h4>Erreur lors de l'exécution de la requête :</h4>
                            <p><?php echo $bdd->lastErrorMsg(); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            // Attachez un gestionnaire d'événements au clic sur le bouton "Exécuter la requête"
            document.getElementById('executeQuery').addEventListener('click', function () {
                // Soumettre le formulaire
                document.getElementById('sqlForm').submit();
            });
        </script>
    </body>

    </html>
