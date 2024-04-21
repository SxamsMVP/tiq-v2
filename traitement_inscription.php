<?php
// Connexion à la base de données
$bdd = new SQLite3('database.sqlite');
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $pseudo = htmlspecialchars($_POST['pseudo']); // Assurez-vous que cela correspond à 'name' dans votre formulaire
    $question = 1;

    // Hacher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Gestion du téléchargement de la photo
    $filePath = 'img/profil-defaut.jpg'; // Valeur par défaut
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = $_FILES['photo'];
        $uploadPath = 'img/users/';
        $destination = $uploadPath . basename($photo['name']);
        if (move_uploaded_file($photo['tmp_name'], $destination)) {
            $filePath = $destination;
        }
    }

    // Préparation et exécution de la requête
    $query = "INSERT INTO utilisateurs (nom, prenom, email, password, username, photo_path, question) VALUES (:nom, :prenom, :email, :password, :username, :photo_path, :question)";
    $statement = $bdd->prepare($query);
    $statement->bindValue(':nom', $nom, SQLITE3_TEXT);
    $statement->bindValue(':prenom', $prenom, SQLITE3_TEXT);
    $statement->bindValue(':email', $email, SQLITE3_TEXT);
    $statement->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
    $statement->bindValue(':username', $pseudo, SQLITE3_TEXT); // Corrigé pour correspondre au formulaire
    $statement->bindValue(':photo_path', $filePath, SQLITE3_TEXT);
    $statement->bindValue(':question', $question, SQLITE3_INTEGER);

    if ($statement->execute()) {
        header("Location: connexion.php"); // Redirection si tout est correct
    } else {
        echo 'Erreur lors de l\'inscription.';
    }

    $bdd->close();
}
?>
