<?php

require_once('functions.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user']['id'];

if (isset($_GET['id'])) {
    $oeuvreId = $_GET['id'];

    $bdd = connect();

    // Vérifier si l'utilisateur a déjà liké l'œuvre
    $sql = "SELECT * FROM likes WHERE user_id = :userId AND oeuvre_id = :oeuvreId";
    $sth = $bdd->prepare($sql);
    $sth->execute([
        'userId' => $userId,
        'oeuvreId' => $oeuvreId
    ]);

    $like = $sth->fetch(PDO::FETCH_ASSOC);

    if ($like) {
        $message = "Vous avez déjà liké cette œuvre.";
    } else {
        // Insérer le like dans la table des likes
        $sql = "INSERT INTO likes (user_id, oeuvre_id) VALUES (:userId, :oeuvreId)";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'userId' => $userId,
            'oeuvreId' => $oeuvreId
        ]);

        // Mettre à jour le nombre de likes de l'œuvre uniquement si le like a été inséré avec succès
        if ($sth->rowCount() > 0) {
            $sql = "UPDATE oeuvres SET nombre_likes = nombre_likes + 1 WHERE id = :oeuvreId";
            $sth = $bdd->prepare($sql);
            $sth->execute([
                'oeuvreId' => $oeuvreId
            ]);

            $message = "Vous avez liké l'œuvre avec succès.";
        } else {
            $message = "Erreur lors du like de l'œuvre.";
        }
    }
} else {
    $message = "Aucun identifiant d'œuvre spécifié.";
}

$message = urlencode($message);
$redirectURL = $_SERVER['HTTP_REFERER'];
if (strpos($redirectURL, '?') !== false) {
    $redirectURL .= '&message=' . $message;
} else {
    $redirectURL .= '?message=' . $message;
}

header('Location: ' . $redirectURL);
exit();

?>
