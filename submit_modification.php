<?php
session_start();
include('header.php');

if (isset($_POST['id'], $_POST['table'], $_POST['question'], $_POST['reponse'], $_POST['path_uml'])) {
    $id = SQLite3::escapeString($_POST['id']);
    $table = SQLite3::escapeString($_POST['table']);
    $question = SQLite3::escapeString($_POST['question']);
    $reponse = SQLite3::escapeString($_POST['reponse']);
    $path_uml = SQLite3::escapeString($_POST['path_uml']);

    $sql = "UPDATE $table SET question = '$question', reponse = '$reponse', path_uml = '$path_uml' WHERE id = '$id'";

    if ($bdd->exec($sql)) {
        echo "<script>alert('Modification enregistrée avec succès.'); window.location.href='gerer_questions.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de l'enregistrement des modifications.'); window.location.href='gerer_questions.php';</script>";
    }
} else {
    echo "<script>alert('Données manquantes pour la modification.'); window.location.href='gerer_questions.php';</script>";
}
$bdd->close();
?>
