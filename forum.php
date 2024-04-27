<?php
session_start();
include('header.php');

// Handle like action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like']) && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id']; // Ensure the user is logged in

    // Check if the user has already liked this post
    $check = $bdd->querySingle("SELECT count(*) FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'");

    if ($check == 0) {
        // Insert the like
        $insert = $bdd->exec("INSERT INTO likes (post_id, user_id) VALUES ('$post_id', '$user_id')");
        if (!$insert) {
            echo "<script>alert('Error liking post.');</script>";
        }
    } else {
    }
}

// Fetch posts and their like counts
$result = $bdd->query('SELECT p.*, u.username, u.photo_path, (SELECT COUNT(*) FROM likes WHERE likes.post_id = p.post_id) AS like_count FROM posts p JOIN utilisateurs u ON p.user_id = u.id ORDER BY p.created_at DESC');

$posts = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $posts[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CHALLENGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/header_menu.css">
    <style>
        body {
            background-color: skyblue;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .card {
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            /* Aligns children in a column */
            position: relative;
            /* For absolute positioning of likes count */
        }

        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .post-header {
            flex-grow: 1;
            /* Ensures it takes up necessary space */
        }


        .card-title {
            font-size: 20px;
            /* Augmenter la taille de la police pour le titre */
            color: #333;
            /* Couleur plus foncée pour une meilleure lisibilité */
        }

        .profile-photo {
            width: 50px;
            /* Dimensionner correctement la photo de profil */
            height: 50px;
            /* Garder un aspect carré */
            border-radius: 50%;
            /* Rendre la photo de profil circulaire */
            margin-right: 10px;
            /* Espacer la photo du texte */
            vertical-align: middle;
            /* Aligner verticalement avec le texte */
        }

        .card-subtitle {
            color: #666;
            /* Couleur plus claire pour les sous-titres */
            margin-top: 10px;
            /* Espacer le sous-titre du titre */
        }

        .card-link {
            color: #0056b3;
            /* Couleur bleue pour les liens */
            margin-right: 15px;
            /* Espacer les liens */
        }

        .card-link:hover {
            text-decoration: none;
            /* Enlever le soulignement au survol */
            color: #004494;
            /* Assombrir la couleur au survol */
        }

        .btn-primary {
            color: #ffffff;
            background-image: linear-gradient(135deg, #6e8efb, #a777e3);
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-image: linear-gradient(to left, #6478fb, #8763e4);
            /* Change gradient direction on hover/focus */
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.3);
            /* Enhanced shadow for lifted effect */
            transform: translateY(-2px);
            /* Slight raise on hover */
        }

        .btn-primary:active {
            background-image: linear-gradient(135deg, #5767c9, #7a55c1);
            /* Darken colors on active state */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Smaller shadow suggests button is pressed */
            transform: translateY(1px);
            /* Button looks pressed down */
        }

        .form-inline {
            display: flex;
            align-items: center;
            /* Vertically center the items */
            justify-content: flex-start;
            /* Aligns children at the start of the container */
            width: 100%;
            /* Takes full width to utilize the space */
        }

        .likes-count {
            max-width: 80px;
            /* Removes shadow */
            padding: 0;
            /* No padding */
            font-size: 16px;
            /* Adjust font size as needed */
            border-radius: 0;
            /* No rounded corners */
            background-color: blue;
            /* Change gradient direction on hover/focus */
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            position: absolute;
            bottom: 20px;
            right: 10px;
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

                // Affichez la photo de profil si le chemin est disponible
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

    <body>
        <div class="container">
            <a href="create_post.php" class="btn btn-primary ">Créer un nouveau post </a>
            <?php foreach ($posts as $post) : ?>
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        <div class="post-header">
                            <div>
                                <img src="<?= htmlspecialchars($post['photo_path']) ?>" alt="Profile Photo" class="profile-photo">
                                <strong><?= htmlspecialchars($post['username'] ?? 'Unknown user') ?></strong>
                            </div>
                            <h6 class="card-subtitle mb-2 text-black">Posté par <?= htmlspecialchars($post['username']) ?> - <?= $post['created_at'] ?></h6>
                            <h5 class="card-title"><?= htmlspecialchars($post['content']) ?></h5>
                        </div>
                        <!-- Lien pour répondre au post -->
                        <form method="post" class="mt-auto">
                            <button type="button" onclick="location.href='reply_post.php?post_id=<?= $post['post_id'] ?>'" class="btn btn-primary mr-3">Commentaire</button>
                            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                            <button type="submit" name="like" class="btn btn-primary ml-3">Like</button>
                        </form>
                    </div>
                    <span class="likes-count text-right "><?= $post['like_count'] ?> <i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                </div>
            <?php endforeach; ?>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>