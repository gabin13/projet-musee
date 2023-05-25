<?php
require_once('functions.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$bdd = connect();


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM oeuvres WHERE categorie = 'tableaux' AND id = $id";
    $sth = $bdd->prepare($sql);
    $sth->execute();
    $oeuvres = $sth->fetchAll();
    echo '<div class="container">';
    if (isset($oeuvres)) {
        foreach ($oeuvres as $oeuvre) {
            echo '<div class="image-container image-' . $oeuvre['id'] . '">';
            echo '<img class= "img3" src="tableaux/' . $oeuvre['image_url'] . '" alt="Image de l\'oeuvre" width="370" height="500" >';
            echo '</div>';
        }

    $sql = "SELECT * FROM oeuvres WHERE categorie = 'tableaux' AND id = $id";
    $sth = $bdd->prepare($sql);
    $sth->execute();

    $oeuvre = $sth->fetch(PDO::FETCH_ASSOC);

    if ($oeuvre) {
        $description = $oeuvre['description'];
    
    echo '<div class="oeuvre-info">';
    echo "Nom: " . $oeuvre['nom'] . "<br>";
    echo "Auteur: " . $oeuvre['auteur'] . "<br>";
    echo "Annee: " . $oeuvre['annee'] . "<br>";
    echo'</div>';

    echo '<div class="oeuvre-description">';
    echo "Description: " . $oeuvre['description'] . "<br>";
    echo'</div>';

    echo'</div>';

    }
    
    
    echo "<br>";
    } else {
        echo "Œuvre introuvable.";
    }
} else {
    echo "Aucun identifiant d'œuvre spécifié.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/categorie.css" />
    <link rel="stylesheet" href="styles/oeuvre.css" />
</head>
<body class= "container">
<?php require_once('_nav.php'); ?>
    
</body>
</html>