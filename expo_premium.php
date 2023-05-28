<?php require_once('functions.php'); ?>
<?php require_once('_nav.php'); ?>
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





<h1>Bienvenue dans notre exposition</h1>
  
<H2>Catégories: </H2>


<a href="objets_decoratifs.php">
    <figure>
        <div class="sculptures">
            <div class="gris_fonce"></div>
            <img src="objets_decoratifs/Adrien Dalpayrat.jpg" alt="">
        </div>
        <figcaption>
            <a href="objets_decoratifs">Objets Décoratifs</a>
        </figcaption>
    </figure>
</a>


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

<?php require_once('_footer.php'); ?>


</body>
</html>
