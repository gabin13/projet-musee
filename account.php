<?php require_once('functions.php'); ?>
<link rel="stylesheet" href="styles/account.css" />

<?php 
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    $bdd = connect();

    $sql = "SELECT * FROM users WHERE id = :user_id";

    $sth = $bdd->prepare($sql);
        
    $sth->execute([
        'user_id'     => $_SESSION['user']['id']
    ]);

    $user = $sth->fetch();

?>

<?php require_once('_header.php'); ?>
<div class="container">
    <h1>Votre compte</h1>

    <?php if (isset($_GET['msg'])) {
        echo "<div>" . $_GET['msg'] . "</div>";
    }?>

    <div class="account-details">
        <div class="avatar-place avatar-overlay">
    <img src="Images/<?php echo $_SESSION['user']['avatar']; ?>" alt="Avatar" />
    <div class="overlay-text">Modifier l'avatar</div>
</div>
        <div class="user-details">
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Nom:</strong> <?php echo $user['nom']; ?></p>
            <p><strong>Prénom:</strong> <?php echo $user['prenom']; ?></p>
            <p><strong>Adresse postale:</strong> <?php echo $user['adresse']; ?></p>
        </div>
    </div>

    <div class="actions">
        <a href="account_edit2.php?id=<?php echo $user['id']; ?>" class="btn-modif2">Modifier les détails</a>
        <a href="account_del.php?id=<?php echo $user['id']; ?>" onClick="return confirm('Voulez-vous vraiment supprimer ce compte ?');" class="btn-supp">Supprimer</a>
    </div>
</div>
</body>
</html>
