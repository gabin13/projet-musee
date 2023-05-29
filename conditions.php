<?php
require_once('functions.php');


if (isset($_GET['id'])) {
    $userid = $_GET['id'];
    $bdd = connect();

    
    $sql = "SELECT * FROM users WHERE id = :id;";
    $sth = $bdd->prepare($sql);
    $sth->execute(['id' => $userid]);
    $user = $sth->fetch();
}
?>
<?php require_once('_nav.php'); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Conditions d'utilisations - MuséeO-tech</title>
    <link rel="stylesheet" href="styles/confidentialite.css">
    <link rel="stylesheet" href="styles/footer.css">
</head>
<br><br>
<body>
<header>
        <h1>MuséeO-tech</h1>
    </header>

    <div class="container">
        <h2>Conditions d'utilisation</h2>
        <p>
            Bienvenue sur le site web du MuséeO-tech. En accédant à ce site et en l'utilisant, vous acceptez de vous conformer aux présentes conditions d'utilisation.
        </p>

        <h3>1. Utilisation du site</h3>
        <p>
            L'utilisation de ce site est soumise aux lois et réglementations en vigueur. Vous acceptez de ne pas utiliser ce site à des fins illégales ou interdites.
        </p>

        <h3>2. Propriété intellectuelle</h3>
        <p>
            Tous les contenus présents sur ce site, y compris mais sans s'y limiter, les textes, les images, les vidéos, les logos et les marques de commerce, sont la propriété exclusive du MuséeO-tech ou de ses partenaires. Toute reproduction, distribution, modification ou utilisation non autorisée de ces contenus est strictement interdite.
        </p>

        <h3>3. Liens vers des sites tiers</h3>
        <p>
            Ce site peut contenir des liens vers des sites web de tiers. Le MuséeO-tech n'exerce aucun contrôle sur ces sites et n'assume aucune responsabilité quant à leur contenu ou à leur utilisation.
        </p>

        <h3>4. Limitation de responsabilité</h3>
        <p>
            Le MuséeO-tech ne peut garantir l'exactitude, l'exhaustivité ou la fiabilité des informations présentes sur ce site. En utilisant ce site, vous acceptez de le faire à vos propres risques et vous libérez le MuséeO-tech de toute responsabilité.
        </p>

        <div class="btn-retour">
    <a class="btn" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
</div>

    </div>
    <?php require_once('_footer.php'); ?>
</body>
</html>
