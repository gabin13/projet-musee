<?php
require_once('functions.php');

if (isset($_GET['id'])) {
    $userid = $_GET['id'];
    $bdd = connect();
    $sql = "SELECT * FROM users WHERE id = :id;";
    
    $sth = $bdd->prepare($sql);
    
    $sth->execute([
        'id' => $userid
    ]);
    
    // Vérifier si l'utilisateur existe
    if ($sth->rowCount() === 0) {
        echo "Utilisateur non trouvé.";
    } else {
        $user = $sth->fetch(PDO::FETCH_ASSOC);
        
        // Vérifier si le formulaire a été soumis
        if (isset($_POST['submit'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $adresse = $_POST['adresse'];
            
            $bdd = connect();
            $sql = "UPDATE users SET nom = :nom, prenom = :prenom, adresse = :adresse WHERE id = :id;";
            
            $sth = $bdd->prepare($sql);
            
            $sth->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'adresse' => $adresse,
                'id' => $userid
            ]);
            
            echo "Informations mises à jour avec succès.";
        }
    }
?>
