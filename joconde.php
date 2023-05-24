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

    $oeuvre = $sth->fetch(PDO::FETCH_ASSOC);

    if ($oeuvre) {
        $description = $oeuvre['description'];
       
        echo "Nom: " . $oeuvre['nom'] . "<br>";
    echo "Auteur: " . $oeuvre['auteur'] . "<br>";
    echo "Annee: " . $oeuvre['annee'] . "<br>";
    echo "Description: " . $oeuvre['description'] . "<br>";
    echo "Image: <img src='tableaux/" . $oeuvre['image_url'] . "' alt='Image de l'oeuvre'><br>";
    
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
</head>
<body>
    
</body>
</html>