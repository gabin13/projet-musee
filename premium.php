<?php
require_once('functions.php');
 require_once('_header.php'); 

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


if ($user['premium'] === '1') {
   
    header("Location: expo_premium.php");
    exit;
}

$premium_pass = false;
$afficher_erreur = false;
$verification_code = null;
$message_erreur = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['verification_code'])) {
        $enteredCode = $_POST['verification_code'];

        $codedeverification = $_SESSION['verification_code'];

        if ($enteredCode === $codedeverification) {
          
            $sql = "UPDATE users SET premium = '1' WHERE id = :user_id";
            $sth = $bdd->prepare($sql);
            $sth->execute([
                'user_id' => $_SESSION['user']['id']
            ]);

          
            $premium_pass = true;
        } else {
           
            $message_erreur = "Code de vérification incorrect. Veuiller réesayer !";
            $afficher_erreur = true;
            
           
        }
        
    } else {
      
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $anniversaire = $_POST['anniversaire'];
        $interet = $_POST['interet'];
        $motivation = $_POST['motivation'];

       
        $errors = array();

        if (empty($nom)) {
            $errors[] = "nom is required.";
        }

        if (empty($email)) {
            $errors[] = "Email is required.";
        }

        if (empty($anniversaire)) {
            $errors[] = "anniversaire is required.";
        }

        if (empty($interet)) {
            $errors[] = "Artistic interet are required.";
        }

        if (empty($motivation)) {
            $errors[] = "Motivation is required.";
        }

        
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "Error: " . $error . "<br>";
            }
        } else {
            
            $codedeverification = generatecodedeverification(4);

            
            $_SESSION['verification_code'] = $codedeverification;

           
            $afficher_erreur = true;
        }
    }
}


function generatecodedeverification($length)
{
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}
?>
<?php require_once('_nav.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Unlock Premium Access</title>
   
</head>
<link rel="stylesheet" href="styles/premium.css"> 
<link rel="stylesheet" href="styles/footer.css"> 
<style>
  .premium-pass {
    width: 300px;
    height: 180px;
    background-color: #2c3e50;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
    text-transform: uppercase;
    background-image: url("Images/musee_pass.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    color: white;
    position: relative;
    cursor: pointer;
    overflow: hidden;
}

</style>

<body>
    <?php if ($_SESSION['user']['premium'] !== '1' && !$premium_pass) { ?>
        <?php if (!$afficher_erreur) { ?>
            <br><br>
            <div class ="container_premium">
            <h1>Déverrouiller l'accès Premium</h1>
            <p>Bienvenue! Pour accéder au contenu premium, veuillez entrer vos informations :</p>
            <form class="form_container" method="POST" action="">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom" required value="<?php echo isset($nom) ? htmlspecialchars($nom) : ''; ?>">

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">

                <label for="anniversaire">Date d'Anniversaire:</label>
                <input type="date" name="anniversaire" id="anniversaire" required value="<?php echo isset($anniversaire) ? htmlspecialchars($anniversaire) : ''; ?>">
                 <br>
                <label for="interet">Intérêts artistiques:</label>
                <textarea name="interet" id="interet" required><?php echo isset($interet) ? htmlspecialchars($interet) : ''; ?></textarea>

                <label for="motivation">Motivation:</label>
                <textarea name="motivation" id="motivation" required><?php echo isset($motivation) ? htmlspecialchars($motivation) : ''; ?></textarea>

                <input type="submit" value="Submit"> <br><br>
               <a class ="premium_retour" href="expo.php">Retour</a>
            </form>
            </div>
           
        <?php } else { ?>
            <br><br>
            <div class="container_premium">
    <h1>Code de vérification:</h1>
    <p>Un code de vérification vous a été attribué. Veuillez le saisir ci-dessous.:</p>
    <p>Code Générer: <?php echo $codedeverification; ?></p>
    
    <?php
if ($afficher_erreur) {
    echo '<div style="color: red; text-align: center; margin-top: 10px;">' . $message_erreur . '</div>';
}


    ?>
    
    <form method="POST" action="">
        <label for="verification_code">Verification Code:</label>
        <input type="text" name="verification_code" id="verification_code" required>
        <input type="submit" value="Verify"> <br><br>
        <a class ="premium_retour" href="premium.php">Retour</a>
    </form>
</div>

        <?php } ?>
    <?php } ?>
    <?php if ($premium_pass) { ?> <br><br>
        <div class="container_premium">
        <h1>Bienvenue dans l'espace Premium !</h1> <br>
        <p>Vous avez débloqué le pass premium ! Vous pouvez désormais voir toutes nos œuvres !</p> <br><br>
        <a href="expo_premium.php">
            <div class="premium-pass">
              
            </div>
           
        </a> <br>
        <p class="page_premium">Appuyez sur le pass pour être redirigé vers la page Premium</p> <br>
        <a class ="premium_retour" href="premium.php">Retour</a>
        </div>
        
    <?php } ?>
    <?php require_once('_footer.php'); ?>
</body>
</html>
