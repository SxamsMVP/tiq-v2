<?php
session_start();

// Connexion à la base de données SQLite
$bdd = new SQLite3('database.sqlite');
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}

// Récupération du niveau de l'utilisateur
$userLevel = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : 1;

// Sélection de la prochaine question de niveau supérieur dans la base de données
$newLevel = $userLevel + 1;
$newQuestionResult = $bdd->query("SELECT * FROM questions WHERE level = $newLevel ORDER BY RANDOM() LIMIT 1");
$newQuestion = $newQuestionResult->fetchArray(SQLITE3_ASSOC);

// Stockage de la nouvelle question dans la session
$_SESSION['currentQuestion'] = $newQuestion;

// Retourne la nouvelle question au format JSON
echo json_encode($newQuestion);
?>
