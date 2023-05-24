<?php
require_once('functions.php');

if (isset($_POST["send"])) {
    $bdd = connect();
    $sql = "SELECT * FROM users WHERE `email` = :email;";
    
    $sth = $bdd->prepare($sql);
    
    $sth->execute([
        'email'     => $_POST['email']
    ]);

    $user = $sth->fetch();

    if ($user && password_verify($_POST['password'], $user['password']) ) {
        $_SESSION['user'] = $user;
    
            header('Location: expo.php');
        } elseif  ($_POST['email'] === 'admin@admin' && $_POST['password'] === 'admin') {
            header('Location: admin_gerer.php');
        
        exit();
    } else {
        $msg = "Email ou mot de passe incorrect !";
    }
}
?>

<style> 
    body {
        background-image: url('images/Bierstadt_-_Among_the_Sierra_Nevada_Mountains_-_1868.webp');
    }
</style>

<?php require_once('_header.php'); ?>

<div class="container">
    <h1 class="login">Connexion</h1>
    <form action="" method="post">
        <?php if (isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

        <div class="form-group">
            <label for="email">Email:</label>
            <input 
                type="email" 
                placeholder="Entrez votre email" 
                name="email" 
                id="email"
                required
            />
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input 
                type="password" 
                placeholder="Entrez votre mot de passe" 
                name="password" 
                id="password"
                required
            />
        </div>
        <div class="form-group">
            <input type="submit" name="send" value="Connexion" />
        </div>
    </form>
</div>

</body>
</html>
