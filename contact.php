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
    
       
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de contact</title>
    <style>
       
       .rating {
  
  align-items: flex;
}

.rating label {
  margin-bottom: 0;
  float: right;
            cursor: pointer;
            color: #777777;
}


        .rating input {
            display: none;
        }

        

        .rating label:before {
            content: "\2605";
            font-size: 24px;
        }

        .rating input:checked ~ label,
        .rating input:checked ~ label ~ label {
            color: #ffcc00;
        }

      
        body {
            font-family: Arial, sans-serif;
        }

        .container_contact {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
        }

        .container_contact h1 {
            text-align: center;
        }

        .form-group_contact {
            margin-bottom: 15px;
        }

        .form-group_contact label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group_contact input[type="text"],
        .form-group_contact input[type="email"],
        .form-group_contact textarea,
        .form-group_contact select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group_contact textarea {
            height: 100px;
        }
         .form-group_contact {
  margin-bottom: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.form-group_contact .btn {
  margin-top: auto;
  padding: 10px 20px;
  background-color: grey;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

        .form-group_contact .btn:hover {
            background-color: #45a049;
        }
      
    </style>
</head>
<?php require_once('_header.php'); ?>
<body>
    <div class="container_contact">
    <?php
$userid = isset($_GET['id']) ? $_GET['id'] : '';

?>
        <h1>Formulaire de contact</h1>
        <form method="POST" action="traitement_formulaire.php?id=<?php echo $userid; ?>">
        <input type="hidden" name="id" value="<?php echo $userid; ?>">

       
            <div class="form-group_contact">
                <label class="label_contact" for="nom">Nom :</label>
                <input class="input_contact" type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group_contact">
                <label class="label_contact" for="prenom">Prénom :</label>
                <input class= "input_contact" type="text" id="prenom" name="prenom" required>
            </div>

            <div class="form-group_contact">
                <label  class="label_contact" for="email">Email :</label>
                <?php
// Assuming $user variable contains the logged-in user's information
$email = $user['email'];
?>

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
        </form>
    </div>
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

</body>
</html>
