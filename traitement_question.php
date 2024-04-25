<?php
// Connexion à la base de données
$bdd = new SQLite3('database.sqlite');

// Vérification de la connexion
if (!$bdd) {
    die("Erreur de connexion à la base de données");
}

// Initialisation d'un message
$message = "";

// Récupération des données du formulaire
$question = $_POST['question'];
$reponse = $_POST['reponse'];
$table = $_POST['table'];
$imgpath = $_POST['imgpath'];

// Récupérer le dernier ID
$result = $bdd->query("SELECT MAX(id) as max_id FROM $table");
$row = $result->fetchArray();
$lastId = $row['max_id'];
$newId = $lastId + 1; // Calculer le nouvel ID

// Ajout des données à la base de données
$query = "INSERT INTO $table (id, question, reponse, path_uml) VALUES (:id, :question, :reponse, :imgpath)";
$statement = $bdd->prepare($query);

if ($statement === false) {
    $message = "Erreur de préparation de la requête: " . $bdd->lastErrorMsg();
} else {
    $statement->bindValue(':id', $newId, SQLITE3_INTEGER);
    $statement->bindValue(':question', $question, SQLITE3_TEXT);
    $statement->bindValue(':reponse', $reponse, SQLITE3_TEXT);
    $statement->bindValue(':imgpath', $imgpath, SQLITE3_TEXT);

    $result = $statement->execute();

    if ($result === false) {
        $message = "Erreur lors de l'exécution de la requête: " . $bdd->lastErrorMsg();
    } else {
        $message = "Nouvelle question ajoutée avec succès!";
    }
}

// Fermeture de la connexion
$bdd->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de l'ajout</title>
</head>
<body>
    <script>
        alert("<?php echo addslashes($message); ?>");
        window.location.href = 'add_question.php'; // Redirige vers la page d'accueil après l'affichage du message
    </script>
</body>
</html>
