<?php

require_once('functions.php');

if (isset($_POST["submit"])) {
    $bdd = connect();
    $sql = "SELECT * FROM users WHERE `email` = :email;";
    
    $sth = $bdd->prepare($sql);
    
    $sth->execute([
        'email' => $_POST['email']
    ]);

    $user = $sth->fetch();
    
    if ($username === 'admin' && $password === 'admin') {
       
        $_SESSION['username'] = $username;
        header('Location: admin_gerer.php'); 
        exit();
    } else {
        $msg = "Email ou mot de passe incorrect !";
    }
}
?>





<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion administrateur</title>
</head>
<body>
    <h1>Page de connexion administrateur</h1>
    <?php if (isset($msg)) { ?>
        <p style="color: red;"><?php echo $msg; ?></p>
    <?php } ?>
    <form method="post" action="">
        <label for="email">Nom d'utilisateur:</label>
        <input type="text" name="email" required><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Se connecter">
    </form>
</body>
</html>
