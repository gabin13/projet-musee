<?php require_once('functions.php'); ?>
<?php 
   

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit(); 
    }

    $bdd = connect();

    $sql = "SELECT * FROM oeuvres WHERE categorie = 'objets_decoratifs'";

    $sth = $bdd->prepare($sql);
        
    $sth->execute();

    $oeuvres = $sth->fetchAll();
?>

<link rel="stylesheet" href="styles/oeuvre.css"> 
<link rel="stylesheet" href="styles/footer.css"> 

<?php require_once('_nav.php'); ?>


    <div class="register">
    <h1>Les Objets décoratifs:  </h1>

    <?php if (isset($_GET['msg'])) {
        echo "<div>" . $_GET['msg'] . "</div>";
    }?>


    <table class="table">
        <tbody>
            <?php foreach ($oeuvres as $oeuvre) { ?>
                <tr class="cadre">
                    <td class="stats"><?php echo $oeuvre['id']; ?></td>
                    <td class=""><?php echo $oeuvre['nom']; ?></td>
                    <td class="stats"><img src="objets_decoratifs/<?php echo $oeuvre['image_url']; ?>" /></td>
                    <td align="right">
                    <a class="savoir_plus" href="objets.php?id=<?php echo $oeuvre['id']; ?>">En savoir plus...</a>
                    <br>
                </tr>
            <?php } ?>
        </tbody><br><br>
    </table><br><br>
    <div class="btn-retour">
    <a class="btn" href="expo.php">Retour</a>
</div> 
    </div>
    <?php require_once('_footer.php'); ?>
    
</body>
</html>