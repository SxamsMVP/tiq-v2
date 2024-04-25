<?php
session_start();
include('header.php'); // Inclure le fichier de configuration de la base de données

if (isset($_POST['id']) && isset($_POST['table'])) {
    $id = SQLite3::escapeString($_POST['id']);
    $table = SQLite3::escapeString($_POST['table']);
    switch ($table) {
        case 'select':
            $table = 'select_questions';
            break;
        case 'where':
            $table = 'where_questions';
            break;
        case 'parcours':
            $table = 'parcours_questions';
            break;
        case 'having':
            $table = 'having_questions';
            break;
        case 'groupby':
            $table = 'groupby_questions';
            break;
        case 'aggregation':
            $table = 'aggregation_questions';
            break;
        case 'join':
            $table = 'join_questions';
            break;
    }
    // Construire la requête SQL pour supprimer la question
    $sql = "DELETE FROM $table WHERE id = '$id'";

    if ($bdd->exec($sql)) {
        echo "<script>alert('Question supprimée avec succès.'); window.location.href='gerer_questions.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression de la question.'); window.location.href='gerer_questions.php';</script>";
    }
} else {
    echo "<script>alert('Aucune question ou table spécifiée pour la suppression.'); window.location.href='gerer_questions.php';</script>";
}

$bdd->close();
