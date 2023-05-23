<?php
require_once('functions.php');


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if ($username === 'admin' && $password === 'admin') {
       
        $_SESSION['username'] = $username;
        header('Location: admin_gerer.php'); 
        exit();
    } else {
        $errorMessage = 'Nom d\'utilisateur ou mot de passe incorrect.';
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
    <?php if (isset($errorMessage)) { ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php } ?>
    <form method="post" action="">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Se connecter">
    </form>
</body>
</html>
