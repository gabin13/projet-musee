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
    <title>Politique de confidentialité - MuséeO-tech</title>
    <link rel="stylesheet" href="styles/confidentialite.css">
</head>
<body>
    <header>
        <h1>Politique de confidentialité</h1>
    </header>

    <div class="container">
        <p>
            Cette politique de confidentialité explique comment nous recueillons, utilisons, partageons et protégeons les informations personnelles des utilisateurs de notre site web, MuséeO-tech. Nous nous engageons à respecter et à protéger la vie privée de nos utilisateurs. En utilisant notre site web, vous consentez à la collecte et à l'utilisation de vos informations personnelles conformément à cette politique.
        </p>

        <h2>1. Collecte d'informations</h2>
        <p>
            Nous collectons les informations personnelles que vous nous fournissez volontairement lors de l'utilisation de notre site web, telles que votre nom, votre adresse e-mail et toute autre information que vous choisissez de nous communiquer.
        </p>

        <h2>2. Utilisation des informations</h2>
        <p>
            Nous utilisons les informations personnelles que nous collectons pour les finalités suivantes :
        </p>
        <ul>
            <li>Vous fournir les services et informations demandés.</li>
            <li>Améliorer votre expérience sur notre site web.</li>
            <li>Communiquer avec vous concernant nos produits, services, offres spéciales ou promotions.</li>
            <li>Personnaliser et adapter le contenu et les annonces selon vos intérêts.</li>
            <li>Répondre à vos demandes et vous fournir un service clientèle efficace.</li>
            <li>Protéger nos droits, notre propriété ou notre sécurité, ainsi que ceux de nos utilisateurs et du public en général.</li>
        </ul>

        <h2>3. Partage des informations</h2>
        <p>
            Nous ne vendons, n'échangeons ni ne louons vos informations personnelles à des tiers, sauf dans les cas suivants :
        </p>
        <ul>
            <li>Lorsque cela est nécessaire pour fournir les services demandés par vous.</li>
            <li>Lorsque nous sommes légalement tenus de le faire.</li>
            <li>Lorsque nous estimons que la divulgation est nécessaire pour protéger nos droits, notre propriété ou notre sécurité, ainsi que ceux de nos utilisateurs et du public en général.</li>
            <li>Lorsque vous avez donné votre consentement explicite pour le partage de vos informations.</li>
        </ul>

        <h2>4. Sécurité des informations</h2>
        <p>
            Nous mettons en œuvre des mesures de sécurité appropriées pour protéger vos informations personnelles contre tout accès non autorisé, altération, divulgation ou destruction. Cependant, veuillez noter qu'aucune méthode de transmission sur Internet ou de stockage électronique n'est totalement sécurisée, et nous ne pouvons garantir une sécurité absolue des informations.
        </p>

        <h2>5. Liens vers d'autres sites web</h2>
        <p>
            Notre site web peut contenir des liens vers d'autres sites web qui ne sont pas exploités par nous. Nous n'avons aucun contrôle sur le contenu et les pratiques de ces sites et déclinons toute responsabilité quant à leur contenu, leurs politiques de confidentialité ou leurs pratiques. Nous vous recommandons de consulter les politiques de confidentialité de ces sites web avant de fournir vos informations personnelles.
        </p>

        <h2>6. Modifications de la politique de confidentialité</h2>
        <p>
            Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. Toute modification sera publiée sur cette page avec une nouvelle date d'entrée en vigueur. Nous vous encourageons à consulter régulièrement cette politique pour rester informé de nos pratiques en matière de confidentialité.
        </p>

        <h2>7. Nous contacter</h2>
        <p>
            Si vous avez des questions concernant cette politique de confidentialité, veuillez nous contacter à l'adresse suivante : privacy@museeotech.com.
        </p>
        <div class="btn-retour">
            <a class="btn" href="contact.php?id=<?php echo $_SESSION['user']['id']; ?>">Retour</a>
        </div>
    
    </div>
 
    <footer>
        <p>&copy; 2023 MuséeO-tech. Tous droits réservés.</p>
    </footer>
</body>
</html>
