<?php
require_once('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Votre compte</title>
    <link rel="stylesheet" href="styles/account.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$bdd = connect();

$sql = "SELECT * FROM users WHERE id = :user_id";
$sth = $bdd->prepare($sql);
$sth->execute([
    'user_id' => $_SESSION['user']['id']
]);
$user = $sth->fetch();
$afficherBoutonModifierPass = true;
$afficherBoutonModifier = true; // Variable pour contrôler la visibilité du bouton "Modifier"

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'modifier_prenom') {
        // Afficher le formulaire de modification
        $_POST['submit_prenom'] = 'Enregistrer';
        $afficherBoutonModifier = false; // Cacher le bouton "Modifier"
    } elseif ($_POST['action'] == 'enregistrer_prenom') {
        // Traiter les données enregistrées
        $newPrenom = $_POST['new_prenom'];
        $sql = "UPDATE users SET prenom = :prenom WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'prenom' => $newPrenom,
            'id' => $_SESSION['user']['id']
        ]);
        // Mettre à jour la valeur affichée
        $user['prenom'] = $newPrenom;
        $afficherBoutonModifier = true; // Afficher à nouveau le bouton "Modifier"
    }
}

$afficherBoutonModifierNom = true; // Variable pour contrôler la visibilité du bouton "Modifier" pour le nom
$afficherBoutonModifierAdresse = true; // Variable pour contrôler la visibilité du bouton "Modifier" pour l'adresse

if (isset($_POST['action_nom'])) {
    if ($_POST['action_nom'] == 'modifier_nom') {
        // Afficher le formulaire de modification pour le nom
        $_POST['submit_nom'] = 'Enregistrer';
        $afficherBoutonModifierNom = false; // Cacher le bouton "Modifier" pour le nom
    } elseif ($_POST['action_nom'] == 'enregistrer_nom') {
        // Traiter les données enregistrées pour le nom
        $newNom = $_POST['new_nom'];
        $sql = "UPDATE users SET nom = :nom WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'nom' => $newNom,
            'id' => $_SESSION['user']['id']
        ]);
        // Mettre à jour la valeur affichée
        $user['nom'] = $newNom;
        $afficherBoutonModifierNom = true; // Afficher à nouveau le bouton "Modifier" pour le nom
    }
}


if (isset($_POST['action_adresse'])) {
    if ($_POST['action_adresse'] == 'modifier_adresse') {
        // Afficher le formulaire de modification pour l'adresse
        $_POST['submit_adresse'] = 'Enregistrer';
        $afficherBoutonModifierAdresse = false; // Cacher le bouton "Modifier" pour l'adresse
    } elseif ($_POST['action_adresse'] == 'enregistrer_adresse') {
        // Traiter les données enregistrées pour l'adresse
        $newAdresse = $_POST['new_adresse'];
        $sql = "UPDATE users SET adresse = :adresse WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'adresse' => $newAdresse,
            'id' => $_SESSION['user']['id']
        ]);
        // Mettre à jour la valeur affichée
        $user['adresse'] = $newAdresse;
        $afficherBoutonModifierAdresse = true; // Afficher à nouveau le bouton "Modifier" pour l'adresse
    }
    if (isset($_POST['submit_password'])) {
        if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
              
            if ($new_password == $confirm_password) {
                $sql = "UPDATE users SET password = :password WHERE id = :id";
                $sth = $bdd->prepare($sql);
                $sth->execute([
                    'password' => password_hash($new_password, PASSWORD_DEFAULT),
                    'id' => $_SESSION['user']['id']
                ]);
               
                $successMessage = 'Le mot de passe de l\'utilisateur a été réinitialisé avec succès.';
            } else {
                $errorMessage = 'Les mots de passe ne correspondent pas. Veuillez les saisir à nouveau.';
            }
        }
    }
}
?>

<?php require_once('_nav.php'); ?>
<br><br>
<div class="container">
    <h1>Votre compte</h1>

    <?php if (isset($_GET['msg'])): ?>
        <div><?php echo $_GET['msg']; ?></div>
    <?php endif; ?>

    <div class="account-details">
        <div class="avatar-place avatar-overlay">
            <img src="Images/<?php echo $_SESSION['user']['avatar']; ?>" alt="Avatar">
            <div class="overlay-text">
                <a href="avatar.php">Modifier l'avatar</a>
            </div>
        </div>
        <div class="user-details">
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Nom:</strong> <?php echo $user['nom']; ?></p>

            <?php if (!isset($_POST['submit_nom']) || $_POST['submit_nom'] != 'Enregistrer'): ?>
                <form method="POST" action="">
                    <?php if ($afficherBoutonModifierNom): ?>
                        <input type="hidden" name="action_nom" value="modifier_nom">
                        <input type="submit" name="submit_nom" value="Modifier" class="btn">
                    <?php endif; ?>
                </form>
            <?php else: ?>
                <form method="POST" action="">
                    <input type="text" name="new_nom" placeholder="Nouveau nom" value="<?php echo $user['nom']; ?>">
                    <input type="hidden" name="action_nom" value="enregistrer_nom">
                    <?php if ($afficherBoutonModifierNom): ?>
                        <input type="submit" name="submit_nom" value="Enregistrer" class="btn">
                    <?php else: ?>
                        <input type="submit" name="submit_nom" value="Modifier" class="btn">
                    <?php endif; ?>
                </form>
            <?php endif; ?>

            <p><strong>Prénom:</strong> <?php echo $user['prenom']; ?></p>

            <?php if (!isset($_POST['submit_prenom']) || $_POST['submit_prenom'] != 'Enregistrer'): ?>
                <form method="POST" action="">
                    <?php if ($afficherBoutonModifier): ?>
                        <input type="hidden" name="action" value="modifier_prenom">
                        <input type="submit" name="submit_prenom" value="Modifier" class="btn">
                    <?php endif; ?>
                </form>
            <?php else: ?>
                <form method="POST" action="">
                    <input type="text" name="new_prenom" placeholder="Nouveau prénom" value="<?php echo $user['prenom']; ?>">
                    <input type="hidden" name="action" value="enregistrer_prenom">
                    <?php if ($afficherBoutonModifier): ?>
                        <input type="submit" name="submit_prenom" value="Enregistrer" class="btn">
                    <?php else: ?>
                        <input type="submit" name="submit_prenom" value="Modifier" class="btn">
                    <?php endif; ?>
                </form>
            <?php endif; ?>

            <p><strong>Adresse postale:</strong> <?php echo $user['adresse']; ?></p>

            <?php if (!isset($_POST['submit_adresse']) || $_POST['submit_adresse'] != 'Enregistrer'): ?>
                <form method="POST" action="">
                    <?php if ($afficherBoutonModifierAdresse): ?>
                        <input type="hidden" name="action_adresse" value="modifier_adresse" class="btn">
                        <input type="submit" name="submit_adresse" value="Modifier" class="btn">
                    <?php endif; ?>
                </form>
            <?php else: ?>
                <form method="POST" action="">
                    <input type="text" name="new_adresse" placeholder="Nouvelle adresse" value="<?php echo $user['adresse']; ?>">
                    <input type="hidden" name="action_adresse" value="enregistrer_adresse">
                    <?php if ($afficherBoutonModifierAdresse): ?>
                        <input type="submit" name="submit_adresse" value="Enregistrer" class="btn">
                    <?php else: ?>
                        <input type="submit" name="submit_adresse" value="Modifier" class="btn">
                    <?php endif; ?>
                </form>
            <?php endif; ?>
            <?php if (!$afficherBoutonModifierPass): ?>
                <form method="POST" action="">
                    <h3>Changer le mot de passe</h3>
                    <input type="password" name="new_password" placeholder="Nouveau mot de passe" required class="input-field">
                    <input type="password" name="confirm_password" placeholder="Confirmer le nouveau mot de passe" required class="input-field">
                    <input type="submit" name="submit_password" value="Changer le mot de passe" class="btn">
                </form>
            <?php else: ?>
                <?php if (!isset($_POST['submit_modifier'])): ?>
                    <p><strong>MDP : ********</strong></p>
                    <form method="POST" action="">
                        <input type="submit" name="submit_modifier" value="Modifier" class="btn">
                    </form>
                <?php elseif (!isset($_POST['submit_password'])): ?>
                    <form method="POST" action="">
                        <h3>Changer le mot de passe</h3>
                        <input type="password" name="new_password" placeholder="Nouveau mot de passe" required class="input-field">
                        <input type="password" name="confirm_password" placeholder="Confirmer le nouveau mot de passe" required class="input-field">
                        <input type="submit" name="submit_password" value="Changer le mot de passe" class="btn">
                    </form>
                <?php else: ?>
                    <p>MDP : *******</p>
                    <form method="POST" action="">
                        <input type="submit" name="submit_modifier" value="Modifier" class="btn">
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    
</div>

</body>
</html>
