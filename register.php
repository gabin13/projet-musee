<?php

    require_once('functions.php');

    if (isset($_POST["send"])) {
        $bdd = connect();

        $sql = "INSERT INTO users (`email`, `password`) VALUES (:email, :password);";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'email'     => $_POST['email'],
            'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        header('Location: login.php');
    }
?>

<style> 
    body {
        background-image: url('images/Bierstadt_-_Among_the_Sierra_Nevada_Mountains_-_1868.webp');
    }
</style>

    <?php require_once('_header.php'); ?>
    <div class="container">
    <h1>Création de votre compte</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Email: </label>
            <input 
                type="email" 
                placeholder="Entrez votre email" 
                name="email" 
                id="email" 
                required
            />
        </div>
        <div class="form-group">
            <label for="password">Mot de passe: </label>
            <input 
                type="password" 
                placeholder="Entrez votre mot de passe" 
                name="password" 
                id="password"
                required
            />
        </div>
        <div class="form-group">
            <input class="button" type="submit" name="send" value="Créer" />
        </div>
    </form>
</div>
</body>
</html>