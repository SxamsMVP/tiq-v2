<?php
// Démarrez la session

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Connexion à la base de données
    $bdd = new SQLite3('database.sqlite');

    // Vérification de la connexion
    if (!$bdd) {
        die("Erreur de connexion à la base de données");
    }

    $query = "SELECT photo_path, admin FROM utilisateurs WHERE username = :username";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $userData = $result->fetchArray(SQLITE3_ASSOC);
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}
?>
