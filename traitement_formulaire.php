<?php
// Récupérer les données du formulaire
$commentaire = $_POST['commentaire'];
$note = $_POST['note'];

// Connexion à la base de données
$connexion = mysqli_connect("localhost", "utilisateur", "mot_de_passe", "nom_base_de_donnees");

// Vérifier la connexion
if (mysqli_connect_errno()) {
echo "Échec de la connexion à la base de données : " . mysqli_connect_error();
exit();
}

// Échapper les caractères spéciaux pour éviter les injections SQL
$commentaire = mysqli_real_escape_string($connexion, $commentaire);
$note = mysqli_real_escape_string($connexion, $note);

// Insérer les données dans la base de données
$sql = "INSERT INTO commentaires (commentaire, note) VALUES ('$commentaire', '$note')";

if (mysqli_query($connexion, $sql)) {
echo "Le commentaire a été enregistré avec succès.";
} else {
echo "Erreur lors de l'enregistrement du commentaire : " . mysqli_error($connexion);
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>
