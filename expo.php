<?php require_once('functions.php'); ?>
<?php require_once('_nav.php');


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


?>

<link rel="stylesheet" href="styles/main.css"> 
<link rel="stylesheet" href="styles/footer.css">
<style>
  .premium_categorie .logo_blocage {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 40px;
        background-image: url('Images/cadena.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 3;
    }
</style>




<h1 class="exposition-title">Bienvenue dans notre exposition</h1>

<p class="exposition-description">Explorez l'histoire, l'art et la culture depuis chez vous. Découvrez des trésors culturels du monde entier, de l'art classique à l'art moderne. Plongez dans nos galeries. Apprenez avec des descriptions détaillées. Profitez de visites faîtes par vous même autant de fois que vous le souhaitez. Partagez cette expérience avec vos proches. Explorez, apprenez et émerveillez-vous devant notre musée virtuel. Bonne visite !</p>

<h2 class="exposition-title">Catégories:</h2>

<a href="tableaux.php" class="categorie-link">
    <figure class="categorie-figure">
        <img class="categorie-image tableaux" src="tableaux\800px-Mona_Lisa__by_Leonardo_da_Vinci__from_C2RMF_retouched.jpg" alt="">
        <figcaption>
            <a href="tableaux.php" class="categorie-caption">Tableaux</a>
        </figcaption>
    </figure>
</a>

<a href="sculptures.php" class="categorie-link">
    <figure class="categorie-figure">
        <img class="categorie-image sculptures" src="sculptures\Le-Penseur-rodin-575x1024.png" alt="">
        <figcaption>
            <a href="sculptures.php" class="categorie-caption">Sculptures</a>
        </figcaption>
    </figure>
</a>

<?php if ($user['premium'] === '0') { ?>
    <a href="premium.php">
        <figure class="categorie-figure">
            <div class="premium_categorie">
                <div class="gris_fonce"></div>
                <img class="categorie-image objets_decoratifs" src="objets_decoratifs/Adrien Dalpayrat.jpg" alt="">
                <div class="logo_blocage"></div>
            </div>
            <figcaption>
                <a class="categorie-caption" href="premium.php">Objets Décoratifs</a>
            </figcaption>
        </figure>
    </a>
<?php } else { ?>
    <a href="objets_decoratifs.php" class="categorie-link">
    <figure class="categorie-figure">
        <img class="categorie-image objets_decoratifs" src="objets_decoratifs/Adrien Dalpayrat.jpg" alt="">
        <figcaption>
            <a href="objet_decoratifs.php" class="categorie-caption">Objets Décoratifs</a>
        </figcaption>
    </figure>
    </a>
<?php } ?>

<?php if ($user['premium'] === '0') { ?>
    <a href="premium.php">
        <figure class="categorie-figure">
            <div class="premium_categorie">
                <div class="gris_fonce"></div>
                <img class="categorie-image objets_decoratifs" src="art_numerique/Image3.jpg" alt="">
                <div class="logo_blocage"></div>
            </div>
            <figcaption>
                <a class="categorie-caption" href="premium.php">Art Numérique</a>
            </figcaption>
        </figure>
    </a>
<?php } else { ?>
    <a href="art_numerique.php" class="categorie-link">
    <figure class="categorie-figure">
        <img class="categorie-image art_numerique" src="art_numerique/Image3.jpg" alt="">
        <figcaption>
            <a href="art_numerique.php" class="categorie-caption">Art Numérique</a>
        </figcaption>
    </figure>
    </a>
<?php } ?>


<?php require_once('_footer.php'); ?>

</body>
</html>
