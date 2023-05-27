<link rel="stylesheet" href="styles/nav.css" />
<?php require_once('functions.php'); 
$bdd = connect();

$sql = "SELECT * FROM users";
$sth = $bdd->prepare($sql);
$sth->execute();
$users = $sth->fetchAll();

?>

<style>

.nav-avatar {
  display: inline-block;
  width: 40px; /* adjust the width and height as per your requirements */
  height: 40px;

   
   position: absolute;
   top: 50%;
   left: -40px;
   transform: translateY(-50%);
   width: 30px;
   height: 30px;
   border-radius: 50%;
   background-color: #ffffff;
   color: #333333;
   display: flex;
   align-items: center;
   justify-content: center;
   font-size: 16px;
   
}


.avatar-container {
  width: 100%;
  height: 100%;
  border-radius: 50%; /* creates a circular shape */
  overflow: hidden; /* ensures the image doesn't overflow the container */
}

.avatar-container img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* maintains the image's aspect ratio */
}

</style>

<nav class="navbar">
    <ul>
        <?php if (!isset($_SESSION['user'])){ ?>
            <li><a href="register.php">Créer un compte</a></li>
            <li><a href="login.php">Connexion</a></li>
        <?php } else { ?>
            
        <li>
        <a href="account.php">
        <span class="nav-avatar">
        <div class="avatar-container">
        <img src="Images/<?php echo $_SESSION['user']['avatar']; ?>" alt="Avatar" />
        </div>
        </span>

        <span class="nav-account">Mon Compte</span>
        </a>
        </li>    
        <li><a href="expo.php">Exposition</a></li> 
        <li><a href="premium.php">Premium</a></li> 
        <li><a href="boutique.php">Boutique</a></li>
        <li><a href="contact.php?id=<?php echo $_SESSION['user']['id']; ?>">Contact</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
    </ul>
</nav>