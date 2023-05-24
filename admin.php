<?php
require_once('functions.php');

if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    if ($user === 'admin' && $password === 'admin') {
        $_SESSION['user'] = $user;
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
    <title>ADMIN</title>
    <link rel="stylesheet" href="styles/admin.css"> 
</head>
<body>
    <div class="container">
        <h1>ADMIN</h1>
        <?php if (isset($errorMessage)) { ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php } ?>
        <form method="post" action="">
            <label for="user">Nom d'utilisateur:</label>
            <input type="text" name="user" required><br><br>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" name="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
