<?php
// Démarrez la session

// Connexion à la base de données
$bdd = new SQLite3('database.sqlite');
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT id, photo_path, question, admin FROM utilisateurs WHERE username = :username";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $userData = $result->fetchArray(SQLITE3_ASSOC);
    if ($userData) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['question_index'] = $userData['question']; // Assurez-vous que c'est bien le champ correct pour l'index.
    } else {
        die("Aucun utilisateur trouvé avec ce nom d'utilisateur.");
    }
} else {
    header('Location: connexion.php');
    exit;
}

$questionIndex = $_SESSION['question_index'] ?? 1; 
