<?php require_once('functions.php'); ?>
<?php 
    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit(); 
    }

    $bdd = connect();

    $sql = "SELECT * FROM oeuvres WHERE categorie = 'tableaux'";

    $sth = $bdd->prepare($sql);
        
    $sth->execute();

    $oeuvres = $sth->fetchAll();
?>


<?php require_once('_header.php'); ?>

    <div class="register">
    <h1>Les tableaux:  </h1>

    <?php if (isset($_GET['msg'])) {
        echo "<div>" . $_GET['msg'] . "</div>";
    }?>


    <table class="table">
        <tbody>
            <?php foreach ($oeuvres as $oeuvre) { ?>
                <tr class="cadre">
                    <td class="stats"><?php echo $oeuvre['id']; ?></td>
                    <td class=""><?php echo $oeuvre['nom']; ?></td>
                    <td class="stats"><img src="tableaux/<?php echo $oeuvre['image_url']; ?>" /></td>
                    <td align="right">
                    <a class="stats" href="joconde.php?id=<?php echo $oeuvre['id']; ?>">En savoir plus...</a>
                    <br>
                </tr>
            <?php } ?>
        </tbody><br><br>
    </table><br><br>
    </div>
    <a href="note.php">En savoir plus...</a>
</body>
</html>