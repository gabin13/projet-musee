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

    // Vérifier si l'utilisateur existe
    $sql = "SELECT * FROM users WHERE id = :userId";
    $sth = $bdd->prepare($sql);
    $sth->execute([
        'userId' => $userId
    ]);

    $user = $sth->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Récupérer le nombre de likes actuel pour l'œuvre
        $sql = "SELECT nombre_likes FROM oeuvres WHERE id = :oeuvreId";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'oeuvreId' => $oeuvreId
        ]);

        $row = $sth->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $nombreLikes = $row['nombre_likes'];

            // Incrémenter le nombre de likes
            $nombreLikes++;

            // Mettre à jour le nombre_likes dans la table oeuvres
            $sql = "UPDATE oeuvres SET nombre_likes = :nombreLikes WHERE id = :oeuvreId";
            $sth = $bdd->prepare($sql);
            $sth->execute([
                'nombreLikes' => $nombreLikes,
                'oeuvreId' => $oeuvreId
            ]);

            echo "Vous avez liké l'œuvre avec succès.";
        } else {
            echo "Œuvre introuvable.";
        }
    } else {
        echo "Utilisateur introuvable.";
    }

    // Redirection vers la page précédente
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Aucun identifiant d'œuvre spécifié.";
}
?>
