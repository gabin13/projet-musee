
    <?php
    require_once('functions.php');
  
  
    if (isset($_GET['id'])) {
        $userid = $_GET['id'];
        $bdd = connect();

        $sql = "SELECT * FROM users WHERE id = :id;";
        $sth = $bdd->prepare($sql);
        $sth->execute(['id' => $userid]);
        $user = $sth->fetch();

      
        if ($user) {
            $email = $user['email'];

            $fichier = 'commentaires.txt';

            if (file_exists($fichier)) {
                $contenu = file_get_contents($fichier);

              
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
                       
                        if (strpos($commentaire, "Email : $email") !== false) {
                            echo '<p>' . nl2br($commentaire) . '</p>';
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
