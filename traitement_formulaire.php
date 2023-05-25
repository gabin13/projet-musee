<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
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

    // Enregistrement des données dans un fichier
    $fichier = 'commentaires.txt';
    file_put_contents($fichier, $donneesFormulaire, FILE_APPEND);

    echo "Votre commentaire a été enregistré avec succès.";
} else {
    echo "Une erreur s'est produite lors de l'envoi du formulaire.";
}
?>

<?php
require_once('functions.php');


    $bdd = connect();
    $sql = "SELECT * FROM users WHERE `email` = :email;";
    
    $sth = $bdd->prepare($sql);
    
    $sth->execute([
        'email'     => $_POST['email']
    ]);

    $user = $sth->fetch();
if ($_POST['email'] === 'admin@admin' && $_POST['password'] === 'admin'){
    $fichier = 'commentaires.txt';

    if (file_exists($fichier)) {
        $contenu = file_get_contents($fichier);
        echo nl2br($contenu); // Afficher le contenu avec les sauts de ligne
    } else {
        echo "Le fichier des commentaires n'existe pas.";
    }
}

?>

