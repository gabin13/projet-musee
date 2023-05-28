    <link rel="stylesheet" href="styles/nav.css"> 
    <?php
    require_once('functions.php');
    $bdd = connect();

    $sql = "SELECT * FROM users";
    $sth = $bdd->prepare($sql);
    $sth->execute();
    $users = $sth->fetchAll();
    ?>



    <nav class="navbar">
        <div class="logo-container">
            <div class="logo-circle">
                <img src="Images/musee_pass.jpg" alt="Logo du musée">
            </div>
            <h1 class="museum-name">MuséeO-tech</h1>
        </div>
        <ul>
            <?php if (!isset($_SESSION['user'])) { ?>
                <li><a href="accueil.php"><img src="Images/acceuil.png" alt="Accueil"></a></li>
                <li><a href="register.php">Créer un compte</a></li>
                <li><a href="login.php">Connexion</a></li>
            <?php } else { ?>
            <li><a href="accueil.php"><img src="Images/acceuil.png" alt="Accueil"></a></li>
                <li><a href="expo.php">Exposition</a></li>
                <li><a href="premium.php">Premium</a></li>
                <li><a href="boutique.php">Boutique</a></li>
                <li><a href="contact.php?id=<?php echo $_SESSION['user']['id']; ?>">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php } ?>
        </ul>
        <?php if (isset($_SESSION['user'])) { ?>
        <div class="nav-avatar">
        <a href="account.php">
            <div class="avatar-container">
                <img src="Images/<?php echo $_SESSION['user']['avatar']; ?>" alt="Avatar">
            </div>
        </a>
    </div>

            </div>
        <?php } ?>
    </nav>
    <br><br><br><br>