<?php
session_start();
include('header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

$post_id = $_GET['post_id'] ?? null;

// Ensure post_id is not null before proceeding
if ($post_id === null) {
    die("Post ID is missing.");
}

// Fetch the post data
$post_query = $bdd->querySingle("SELECT p.*, u.username, u.photo_path FROM posts p JOIN utilisateurs u ON p.user_id = u.id WHERE p.post_id = '$post_id'", true);
if ($post_query === false) {
    die("Failed to fetch post data.");
}

$responses_query = $bdd->query("SELECT r.*, u.username, u.photo_path FROM responses r JOIN utilisateurs u ON r.user_id = u.id WHERE r.post_id = '$post_id' ORDER BY r.created_at DESC");
if ($responses_query === false) {
    error_log("SQL error: " . $bdd->lastErrorMsg());  // Log SQL errors to diagnose issues.
    die("Failed to fetch responses.");
}

$responses = [];
while ($response = $responses_query->fetchArray(SQLITE3_ASSOC)) {
    $responses[] = $response;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])) {
    $content = SQLite3::escapeString($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO responses (post_id, user_id, content) VALUES ('$post_id', '$user_id', '$content')";
    if ($bdd->exec($sql)) {
        // After inserting the data, redirect back to the same page
        header("Location: " . $_SERVER['PHP_SELF'] . "?post_id=" . $post_id);
        exit;
    } else {
        $error = "Erreur lors de l'ajout de la réponse.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    // Fetch the owner of the post
    $query = $bdd->querySingle("SELECT user_id FROM posts WHERE post_id = '$post_id'", true);
    if ($query['user_id'] == $user_id || (isset($_SESSION['is_admin']) && $_SESSION['is_admin'])) {
        $delete = $bdd->exec("DELETE FROM posts WHERE post_id = '$post_id'");
        if ($delete) {
            echo "<script>alert('Post deleted successfully.'); window.location.href='forum.php';</script>";
            exit;
        } else {
            echo "Failed to delete the post.";
        }
    } else {
        echo "<script>alert('You do not have permission to delete this post.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Répondre au Post</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/header_menu.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            background-color: skyblue;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            /* Vertically center the items in the flex container */
            padding: 10px;
            justify-content: center;
        }

        .card-body {
            padding: 10px;
            background-color: white;
            /* Optional: to distinguish from header */
            border-top: 1px solid #ddd;
            /* Optional: if you want to visually separate the header from the body */
        }

        strong {
            margin-right: 10px;
            /* Provides spacing between the username and any text that follows */
        }


        .profile-photo {
            width: 50px;
            /* Fixed width */
            height: 50px;
            /* Fixed height */
            border-radius: 50%;
            margin-right: 10px;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .reply-form {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 2px solid #007bff;
        }

        .form-group {
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        textarea.form-control {
            width: 100%;
            height: 150px;
            padding: 10px;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        textarea.form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            border-radius: 0.25rem;
            font-size: 1rem;
            line-height: 1.5;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004095;
        }
    </style>
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
            if (isset($_SESSION['username'])) {
                if (!empty($userData['photo_path'])) {
                    echo '<img src="' . $userData['photo_path'] . '" alt="Photo de profil" class="profile-photo">';
                }
                echo '<a class="text-white stylish-username" href="account.php">' . ucwords($username) . '</a>';
                if ($userData['admin']) {
                    echo '<a class="text-white" href="back_office.php"><i class="fa-solid fa-gear icon-large"></i></a>';
                }
                echo '<a class="text-red" href="logout.php"><i class="fa-solid fa-right-from-bracket logout-icon"></i></a>';
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
        <a href="accueil_exercice.php">Exercices</a>
        <a href="forum.php">Forum</a>
    </div>

    <div class="container">
        <h3>Post</h3>
        <?php if ($post_query) : ?>
            <div class="card">
                <div class="card-header">
                    <img src="<?= htmlspecialchars($post_query['photo_path']) ?>" alt="Profile Photo" class="profile-photo">
                    <strong><?= htmlspecialchars($post_query['username'] ?? 'Unknown user') ?></strong>
                </div>
                <div class="card-body mb-3">
                    <?= htmlspecialchars($post_query['content'] ?? 'No content available') ?>
                </div>
            </div>

        <?php endif; ?>
        <h4 class="mt-3">Réponses</h4>
        <?php foreach ($responses as $response) : ?>
            <div class="card mb-4">
                <div class="card-header">
                    <img src="<?= htmlspecialchars($response['photo_path']) ?>" alt="Profile Photo" class="profile-photo">
                    <strong><?= htmlspecialchars($response['username'] ?? 'Unknown user') ?></strong>
                </div>
                <div class="card-body mb-3">
                    <?= htmlspecialchars($response['content'] ?? 'No content available') ?>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="" method="post" class="reply-form">
            <div class="form-group mt-4">
                <textarea name="content" class="form-control" required placeholder="Tapez votre réponse ici..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>