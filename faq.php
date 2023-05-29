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

    <title>FAQ - MuséeO-tech</title>
    <link rel="stylesheet" href="styles/confidentialite.css">
    <link rel="stylesheet" href="styles/footer.css">
</head>
<br><br>
<body>
    
    <div class = "container">
    <h1>FAQ - MuséeO-tech</h1>

<h2>Questions fréquemment posées</h2>

<div class="faq">
    <h3>Quels sont les horaires d'ouverture du musée ?</h3>
    <p>Le musée est ouvert du mardi au dimanche, de 9h00 à 18h00.</p>
</div>

<div class="faq">
    <h3>Est-ce que le musée est accessible aux personnes à mobilité réduite ?</h3>
    <p>Oui, le musée est entièrement accessible aux personnes à mobilité réduite. Nous disposons d'installations et d'équipements adaptés pour garantir une expérience agréable à tous nos visiteurs.</p>
</div>

<div class="faq">
    <h3>Y a-t-il un parking à proximité du musée ?</h3>
    <p>Oui, il y a un parking gratuit disponible juste à côté du musée. Vous pouvez vous garer facilement et en toute sécurité lors de votre visite.</p>
</div>

<div class="faq">
    <h3>Proposez-vous des visites guidées ?</h3>
    <p>Oui, nous proposons des visites guidées gratuites toutes les heures. Vous pouvez vous inscrire à l'avance ou vous présenter à l'accueil du musée pour réserver votre place.</p>
</div>

<div class="faq">
    <h3>Est-ce que le musée dispose d'un café ou d'un restaurant ?</h3>
    <p>Oui, le musée dispose d'un café-restaurant où vous pouvez vous restaurer pendant votre visite. Nous proposons une variété de plats et de boissons pour satisfaire tous les goûts.</p>
</div>

<div class="faq">
    <h3>Comment puis-je acheter des billets pour le musée ?</h3>
    <p>Vous pouvez acheter des billets directement sur notre site web ou à l'accueil du musée. Nous vous recommandons d'acheter vos billets à l'avance pour éviter les files d'attente.</p>
</div>

<div class="faq">
    <h3>Est-ce que le musée organise des événements spéciaux ?</h3>
    <p>Oui, le musée organise régulièrement des événements spéciaux tels que des expositions temporaires, des conférences et des ateliers. Consultez notre calendrier des événements pour connaître les prochaines activités.</p>
</div>

<div class="faq">
    <h3>Puis-je prendre des photos à l'intérieur du musée ?</h3>
    <p>Oui, vous pouvez prendre des photos à l'intérieur du musée. Cependant, veuillez respecter les règles et les restrictions concernant l'utilisation du flash et des trépieds.</p>
</div>

<div class="faq">
    <h3>Est-ce que le musée est ouvert pendant les jours fériés ?</h3>
    <p>Oui, le musée est ouvert pendant la plupart des jours fériés. Cependant, veuillez consulter notre site web ou nous contacter pour connaître les éventuelles fermetures exceptionnelles.</p>
</div>

<div class="faq">
    <h3>Comment puis-je contacter le service client du musée ?</h3>
    <p>Vous pouvez nous contacter par téléphone au 123-456-789 ou par email à l'adresse info@museeotech.com. Notre équipe se fera un plaisir de répondre à vos questions et de vous aider.</p>
</div>
<div class="btn-retour">
    <a class="btn" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
</div>

    </div>


    <?php require_once('_footer.php'); ?>
</body>
</html>
