<?php
require_once('functions.php');

if (isset($_GET['id'])) {
    $userid = $_GET['id'];
    $bdd = connect();

    $sql = "SELECT * FROM users WHERE id = :id;";
    $sth = $bdd->prepare($sql);
    $sth->execute(['id' => $userid]);
    $user = $sth->fetch();

   $contact_valeur = false;
    if ($user) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $user['email'];
            $nom = $user['nom'];
            $prenom = $user['nom'];
            $raison = $_POST['raison'];
            $note = isset($_POST['note']) ? $_POST['note'] : '';
            $commentaire = $_POST['commentaire'];
            

            $donneesFormulaire = "Nom : $nom\n";
            $donneesFormulaire .= "Prénom : $prenom\n";
            $donneesFormulaire .= "Email : $email\n";
            $donneesFormulaire .= "Raison de contact : $raison\n";
            $donneesFormulaire .= "Note : $note\n";
            $donneesFormulaire .= "Commentaire : $commentaire\n";

           
            $fichier = 'commentaires.txt';
            file_put_contents($fichier, "[Utilisateur ID: $userid]\n$donneesFormulaire\n\n", FILE_APPEND);
            
            $userid = $_GET['id'];
            $sql = "UPDATE users SET note = 1 WHERE id = :id"; 
            $sth = $bdd->prepare($sql);
            $sth->execute(['id' => $userid]);
            
          $contact_valeur = true;
            
        }
    } else {
        echo "Utilisateur non trouvé.";
    }
} else {
    echo "Une erreur s'est produite lors de l'envoi du formulaire.";
}
?>

<?php require_once('_nav.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de contact</title>

    <link rel="stylesheet" href="styles/contact.css"> 
    <link rel="stylesheet" href="styles/footer.css"> 
</head>

<style>
    body {
  background-color: #f2f2f2; 
  background-image: linear-gradient(to bottom, #f2f2f2, #ffffff); 
}
</style>

<body>
    <br><br>
    <div class="container_contact">
    <?php
$userid = isset($_GET['id']) ? $_GET['id'] : '';
$email = $user['email'];
$nom = $user['nom'];
$prenom = $user['prenom'];

    ?>
        <h1>Formulaire de contact</h1>
        
       
         <?php
         if ($contact_valeur == true) {
             echo '<span class="message_sucess">Votre message a été envoyé avec succès !</span>';
         }
         ?>
  

        <form method="POST" action="contact.php?id=<?php echo $userid; ?>">
        <input type="hidden" name="id" value="<?php echo $userid; ?>">

       
            <div class="form-group_contact">
                <label class="label_contact" for="nom">Nom :</label>
                <input class="input_contact" type="text" readonly value="<?php echo $nom; ?>">
            </div>

            <div class="form-group_contact">
                <label class="label_contact" for="prenom">Prénom :</label>
                <input class="input_contact" type="text" readonly value="<?php echo $prenom; ?>">
            </div>

            <div class="form-group_contact">
                <label  class="label_contact" for="email">Email :</label>
                <input class="input_contact" type="email" readonly value="<?php echo $email; ?>">

            </div>

            <div class="form-group_contact">
                <label for="raison_contact">Raison de contact :</label>
                <select id="raison" name="raison" required>
                    <option value="">-- Sélectionnez une raison --</option>
                    <option value="Question">Question</option>
                    <option value="Problème technique">Problème technique</option>
                    <option value="Feedback">Feedback</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>

            <div class="form-group_contact" id="rating-group" style="display: none;">
                <label for="note">Note :</label>
                <div class="rating">
                    <input type="radio" id="star10" name="note" value="10">
                    <label for="star10" title="10/10"></label>
                    <input type="radio" id="star9" name="note" value="9">
                    <label for="star9" title="9/10"></label>
                    <input type="radio" id="star8" name="note" value="8">
                    <label for="star8" title="8/10"></label>
                    <input type="radio" id="star7" name="note" value="7">
                    <label for="star7" title="7/10"></label>
                    <input type="radio" id="star6" name="note" value="6">
                    <label for="star6" title="6/10"></label>
                    <input type="radio" id="star5" name="note" value="5">
                    <label for="star5" title="5/10"></label>
                    <input type="radio" id="star4" name="note" value="4">
                    <label for="star4" title="4/10"></label>
                    <input type="radio" id="star3" name="note" value="3">
                    <label for="star3" title="3/10"></label>
                    <input type="radio" id="star2" name="note" value="2">
                    <label for="star2" title="2/10"></label>
                    <input type="radio" id="star1" name="note" value="1">
                    <label for="star1" title="1/10"></label>
                </div>
            </div>
            <div>
                <span class="note" id="selected-score"></span>
            </div>

            <div class="form-group_contact">
                <label for="commentaire">Commentaire :</label>
                <textarea id="commentaire" name="commentaire"></textarea>
            </div>

            <div class="form-group_contact">
                <input type="submit" value="Envoyer" class="btn">
            </div>
            <div class="form-group_contact">
         <a class="btn" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
           </div>
        </form>
    </div>
    <br><br>
  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#raison').change(function() {
                if ($(this).val() === 'Feedback') {
                    $('#rating-group').show();
                } else {
                    $('#rating-group').hide();
                }
            });

            $('.rating input').click(function() {
                var selectedScore = $(this).val();
                $('#selected-score').text(selectedScore + '/10');
            });
        });
    </script>
 <?php require_once('_footer.php'); ?>
</body>
</html>
