<?php require_once('functions.php'); ?>
<?php 
   

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit(); 
    }

    $bdd = connect();

    $sql = "SELECT * FROM oeuvres WHERE categorie = 'sculptures'";

    $sth = $bdd->prepare($sql);
        
    $sth->execute();

    $oeuvres = $sth->fetchAll();
?>

<link rel="stylesheet" href="styles/main.css"> 
<?php require_once('_nav.php'); ?>

    <div class="register">
    <h1>Les Sculptures:  </h1>

    <?php if (isset($_GET['msg'])) {
        echo "<div>" . $_GET['msg'] . "</div>";
    }?>


    <table class="table">
        <thead>
           
        </thead>
        <tbody>
            <?php foreach ($oeuvres as $oeuvre) { ?>
                <tr class="cadre">
                    <td class="stats"><?php echo $oeuvre['id']; ?></td>
                    <td class="stats"><?php echo $oeuvre['nom']; ?></td>
                    <td><img src="sculptures/<?php echo $oeuvre['image_url']; ?>" /></td>
                    <td align="right">
                    <a class="stats" href="sculp.php?id=<?php echo $oeuvre['id']; ?>">En savoir plus...</a>

                </tr>
            <?php } ?>
        </tbody>
    </table><br><br>
    </div>
</body>
</html>