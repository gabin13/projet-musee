<?php
require_once('functions.php');

if (isset($_GET['id'])) {
    $userid = $_GET['id'];
    $bdd = connect();

    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password == $confirm_password) {
          
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            $sth = $bdd->prepare($sql);

            $sth->execute([
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
                'id' => $userid
            ]);

            $msg = "Le mot de passe de l'utilisateur a été réinitialisé avec succès.";
        } else {
            $msg = "Les mots de passe ne correspondent pas. Veuillez les saisir à nouveau.";
        }
    } else {
        $msg = "Veuillez remplir tous les champs du formulaire.";
    }
} else {
    $msg = "Pas d'utilisateur trouvé avec cet ID !";
}
?>


<?php require_once('_header.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation du mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

    </style>
     <link rel="stylesheet" href="styles/nav.css"> 
    <link rel="stylesheet" href="styles/admin.css"> 
</head>
<body>
    <div class="container_reset_password">
        <h1>Réinitialisation du mot de passe</h1>
        <?php if (isset($_GET['msg'])) { ?>
            <div class="message_reset"><?php echo $_GET['msg']; ?></div>
        <?php } ?>
        <?php if (isset($msg)) { ?>
            <div class="message_warning"><?php echo $msg; ?></div>
        <?php } ?>
        <form action="" method="post">
        <?php if (isset($_GET['user_id'])) { ?>
            <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>" />
        <?php } ?>
            <div class="form-group_reset">
                <label class="label_reset" for="new_password">Nouveau mot de passe :</label>
                <input 
                    
                    type="password" 
                    placeholder="Entrez le nouveau mot de passe" 
                    name="new_password" 
                    id="new_password" 
                    required
                />
            </div>
            <div class="form-group_reset">
                <label class="label_reset" for="confirm_password">Confirmer le mot de passe :</label>
                <input 
                     
                    type="password" 
                    placeholder="Confirmez le nouveau mot de passe" 
                    name="confirm_password" 
                    id="confirm_password" 
                    required
                />
            </div>
            <div class="form-group_reset">
                <input class="button_reset" type="submit" name="reset_password" value="Réinitialiser" />
                <a class="back-button_reset" href="admin_gerer.php">Retour</a>
            </div>
        </form>
    </div>
</body>
</html>
