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


<link rel="stylesheet" href="styles/footer.css">

<h1>Bienvenue dans notre exposition</h1>
    <p>Explorez l'histoire, l'art et la culture depuis chez vous. 
    Découvrez des trésors culturels du monde entier, de l'art classique à l'art moderne. 
    Plongez dans nos galeries. 
    Apprenez avec des descriptions détaillées. 
    Profitez de visites faîtes par vous même autant de fois que vous le souhaitez. 
    Partagez cette expérience avec vos proches. 
    Explorez, apprenez et émerveillez-vous devant notre musée virtuel. Bonne visite !</p><br>
<H2>Catégories: </H2>

<a href="tableaux.php">
    <figure>
        <img class="tableaux" src="tableaux\800px-Mona_Lisa__by_Leonardo_da_Vinci__from_C2RMF_retouched.jpg" alt="">
        <figcaption>
            <a href="tableaux.php">Tableaux</a>
        </figcaption>
    </figure>
</a>

<a href="sculptures.php">
    <figure>
        <img class="sculptures" src="sculptures\Le-Penseur-rodin-575x1024.png" alt="">
        <figcaption>
            <a href="sculptures.php">Sculptures</a>
        </figcaption>
    </figure>
</a>

<?php if ($user['premium'] === '0') { ?>
    <a href="premium.php">
        <figure>
            <div class="premium_categorie">
                <div class="gris_fonce"></div>
                <img src="objets_decoratifs/Adrien Dalpayrat.jpg" alt="">
                <div class="logo_blocage"></div>
            </div>
            <figcaption>
                <a href="premium.php">Objets Décoratifs</a>
            </figcaption>
        </figure>
    </a>
<?php } else { ?>
    <a href="objets_decoratifs.php">
        <figure>
            <div class="sculptures">
                <div class="gris_fonce"></div>
                <img src="objets_decoratifs/Adrien Dalpayrat.jpg" alt="">
            </div>
            <figcaption>
                <a href="objets_decoratifs.php">Objets Décoratifs</a>
            </figcaption>
        </figure>
    </a>
<?php } ?>


<?php if ($user['premium'] === '0') { ?>
    <a href="premium.php">
        <figure>
            <div class="premium_categorie">
                <div class="gris_fonce"></div>
                <img src="art_numerique/Image3.jpg" alt="">
                <div class="logo_blocage"></div>
            </div>
            <figcaption>
                <a href="premium.php">Art Numérique</a>
            </figcaption>
        </figure>
    </a>
<?php } else { ?>
    <a href="art_numerique.php">
        <figure>
            <div class="sculptures">
                <div class="gris_fonce"></div>
                <img src="art_numerique/Image3.jpg" alt="">
            </div>
            <figcaption>
                <a href="art_numerique.php">Art Numérique</a>
            </figcaption>
        </figure>
    </a>
<?php } ?>


<?php require_once('_footer.php'); ?>

</body>
</html>
