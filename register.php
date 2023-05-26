<?php
require_once('functions.php');

if (isset($_POST["send"])) {
    $bdd = connect();
    if ($_POST['email'] === 'admin@admin') {
        
        $msg = "Ce n'est pas pour vous !";
    
    } else {
        $sql = "INSERT INTO users (`email`, `password`, `approuve`, `note`) VALUES (:email, :password, :approuve, :note);";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'email'     => $_POST['email'],
            'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'approuve'  => 0,
            'note'      => 0
        ]);
    }
}
?>

<?php require_once('_header.php'); ?>
<div class="container_register">
    <h1>Création de votre compte</h1>
    <?php if (isset($_GET['msg'])) { ?>
        <div class="message"><?php echo $_GET['msg']; ?></div>
    <?php } ?>
    <?php if (isset($msg)) { ?>
        <div class="message_warning"><?php echo $msg; ?></div>
    <?php } ?>
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
<?php
if (isset($_POST["send"]) && !($_POST['email'] == 'admin@admin')) {
   echo '<div style="display: flex; justify-content: center; align-items: center; height: 20vh; font-size: 50px; font-weight: bold;">
   <p>VEUILLEZ ATTENDRE D\'ÊTRE ACCEPTÉ/REFUSÉ PAR L\'ADMINISTRATEUR</p>
   </div>';
}
?>


</body>
</html>
