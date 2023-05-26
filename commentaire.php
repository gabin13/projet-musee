
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

        // Vérifier si l'utilisateur existe
        if ($user) {
            $email = $user['email'];

            $fichier = 'commentaires.txt';

            if (file_exists($fichier)) {
                $contenu = file_get_contents($fichier);

                // Rechercher les commentaires de l'utilisateur spécifique
                $commentairesUtilisateur = [];
                preg_match_all("/\[Utilisateur ID: $userid\]\n(.*?)\n\n/s", $contenu, $matches);
                if (!empty($matches[1])) {
                    $commentairesUtilisateur = $matches[1];
                }

                echo '<div class="commentaires">'; ?>
  
  <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/admin.css"> 
   
    <title>Commentaires</title>
  
</head>
<?php require_once('_nav.php'); ?>
<body>
<link rel="stylesheet" href="styles/nav.css"> 
<h2 class="h1_commentaire">Commentaires trouvés pour l'utilisateur <?php echo $email; ?> :</h2>


                <?php if (!empty($commentairesUtilisateur)) {
                    
                   
                    foreach ($commentairesUtilisateur as $commentaire) {
                        // Vérifier si l'adresse e-mail de l'utilisateur correspond à celle enregistrée dans le commentaire
                        if (strpos($commentaire, "Email : $email") !== false) {
                            echo '<p>' . nl2br($commentaire) . '</p>'; // Afficher les commentaires de l'utilisateur avec les sauts de ligne
                        }
                    }
                } else {
                    echo '<p class="aucun-commentaire">Aucun commentaire trouvé pour cet utilisateur.</p>';
                }
                
                echo '</div>';
            } else {
                echo '<p>Le fichier des commentaires n\'existe pas.</p>';
            }
        } else {
            echo '<p>Utilisateur non trouvé.</p>';
        }
    } else {
        echo '<p>Aucun utilisateur spécifié.</p>';
    }
    ?>
     <a class="back-button_reset" href="admin_gerer.php">Retour</a>
</body>
</html>
