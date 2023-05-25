<?php require_once('functions.php'); ?>
<?php 
    require_once('functions.php');

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


<?php require_once('_header.php'); ?>

    <div class="register">
    <h1>Les Sculptures:  </h1>

    <?php if (isset($_GET['msg'])) {
        echo "<div>" . $_GET['msg'] . "</div>";
    }?>


    <table class="table">
        <thead>
            <tr>
                <td class="id">ID</td>
                <td class="stats">Nom</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($oeuvres as $oeuvre) { ?>
                <tr>
                    <td class="id"><?php echo $oeuvre['id']; ?></td>
                    <td class="stats"><?php echo $oeuvre['nom']; ?></td>
                    <td><img src="sculptures/<?php echo $oeuvre['image_url']; ?>" /></td>
                    <td align="right">
                    <a class="btn-det" href="sculp.php?id=<?php echo $oeuvre['id']; ?>">En savoir plus...</a>

                </tr>
            <?php } ?>
        </tbody>
    </table><br><br>
    </div>
</body>
</html>