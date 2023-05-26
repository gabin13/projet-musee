<?php
require_once('functions.php');

if (isset($_GET['id'])) {
    $userid = $_GET['id'];
    $bdd = connect();

    // Récupérer les informations de l'utilisateur
    $sql = "SELECT * FROM users WHERE id = :id;";
    $sth = $bdd->prepare($sql);
    $sth->execute(['id' => $userid]);
    $user = $sth->fetch();
     echo $userid;
    // Vérifier si l'utilisateur existe
    if ($user) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $user['email'];
            $nom =  $user['nom'];
            $prenom =  $user['nom'];
            $raison = $_POST['raison'];
            $note = isset($_POST['note']) ? $_POST['note'] : '';
            $commentaire = $_POST['commentaire'];
            
            // Formatage des données du formulaire
            $donneesFormulaire = "Nom : $nom\n";
            $donneesFormulaire .= "Prénom : $prenom\n";
            $donneesFormulaire .= "Email : $email\n";
            $donneesFormulaire .= "Raison de contact : $raison\n";
            $donneesFormulaire .= "Note : $note\n";
            $donneesFormulaire .= "Commentaire : $commentaire\n";

            // Enregistrement des données dans le fichier avec l'ID de l'utilisateur
            $fichier = 'commentaires.txt';
            file_put_contents($fichier, "[Utilisateur ID: $userid]\n$donneesFormulaire\n\n", FILE_APPEND);

            echo "Votre commentaire a été enregistré avec succès.";
            
         $userid = $_GET['id'];
        $sql = "UPDATE users SET note = 1 WHERE id = :id"; 
         $sth = $bdd->prepare($sql);
       $sth->execute(['id' => $userid]);
     }
    } else {
        echo "Utilisateur non trouvé.";
    }
} else {
    echo "Une erreur s'est produite lors de l'envoi du formulaire.";
}
?>
