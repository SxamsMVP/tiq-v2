<?php
// Démarrez la session

// Connexion à la base de données
$bdd = new SQLite3('database.sqlite');
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT id, photo_path, question, select_question_index, where_question_index, aggregation_question_index, groupeby_question_index, having_question_index, join_question_index, admin FROM utilisateurs WHERE username = :username";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $userData = $result->fetchArray(SQLITE3_ASSOC);
    if ($userData) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['question_index'] = $userData['question']; // Assurez-vous que c'est bien le champ correct pour l'index.
        $_SESSION['select_question_index'] = $userData['select_question_index']; // Assurez-vous que c'est bien le champ correct pour l'index.
        $_SESSION['where_question_index'] = $userData['where_question_index']; // Assurez-vous que c'est bien le champ correct pour l'index.
        $_SESSION['aggregation_question_index'] = $userData['aggregation_question_index']; // Assurez-vous que c'est bien le champ correct pour l'index.
        $_SESSION['groupeby_question_index'] = $userData['groupeby_question_index']; // Assurez-vous que c'est bien le champ correct pour l'index.
        $_SESSION['having_question_index'] = $userData['having_question_index']; // Assurez-vous que c'est bien le champ correct pour l'index.
        $_SESSION['join_question_index'] = $userData['join_question_index']; // Assurez-vous que c'est bien le champ correct pour l'index.
    } else {
        die("Aucun utilisateur trouvé avec ce nom d'utilisateur.");
    }
} else {
    header('Location: connexion.php');
    exit;
}

$questionIndex = $_SESSION['question_index'] ?? 1; 
$selectQuestionIndex = $_SESSION['select_question_index'] ?? 1; 
$whereQuestionIndex = $_SESSION['where_question_index'] ?? 1; 
$aggregationQuestionIndex = $_SESSION['aggregation_question_index'] ?? 1; 
$groupebyQuestionIndex = $_SESSION['groupeby_question_index'] ?? 1; 
$havingQuestionIndex = $_SESSION['having_question_index'] ?? 1; 
$joinQuestionIndex = $_SESSION['join_question_index'] ?? 1; 
