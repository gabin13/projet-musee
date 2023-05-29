<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<?php require_once('_nav.php'); ?>  
<head>
    <br><br><br>
  <title>Boutique du Musée</title>
  <link rel="stylesheet" href="styles/boutique.css" />

</head>
<body>
  <header>
    <h1>Boutique du Musée</h1>
  </header>
  
<?php

  $bdd = connect();

    $sql = "SELECT * FROM boutique";
    $sth = $bdd->prepare($sql);
    $sth->execute();
    $boutique = $sth->fetchAll();

  ?>
  
  <main>

<?php

   if (isset($boutique)) {
        foreach ($boutique as $produit) {

            echo '<div class="product" onclick="redirectToAchat(' . $produit['id'] . ')">';
            echo '<img src="Images/' . $produit['image'] . '" alt="' . $produit['nom'] . '">';
            echo '<div class="product-info">';
            echo '<h2 class="product-title">' . $produit['nom'] . '</h2>';
            echo '<p class="product-description">' . $produit['description'] . '</p>';
            echo '<p class="product-price">' . $produit['prix'] . '€</p>';
            echo '</div>';
            echo '</div>'; 
        }
      }

    ?>
        
  </main>

  
  <script>
function redirectToAchat(productID) {
    window.location.href = 'achat.php?id=' + productID;
}
</script>
</body>
</html>