<link rel="stylesheet" href="styles/achat.css">
<?php require_once('functions.php'); ?>

<style>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-top: 50px;
}

.product {
  text-align: center;
}

.product img {
  width: 200px;
  height: 200px;
  margin-bottom: 20px;
}

.product-info {
  text-align: center;
  margin-bottom: 20px;
}

.product-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.product-description {
  font-size: 18px;
  margin-bottom: 10px;
}

.product-price {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

form {
  text-align: center;
  margin-top: 20px;
}

form label {
  display: block;
  margin-bottom: 10px;
}

form input[type="text"] {
  width: 200px;
  padding: 5px;
  margin-bottom: 10px;
}

form input[type="submit"] {
  padding: 10px 20px;
  background-color: #337ab7;
  color: #fff;
  border: none;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #23527c;
}
</style>

<br><br><br>
<div class="container">
  <?php $productID = $_GET['id'];

if ($productID == 1) { ?>
    <div class="product">
      <img src="Images/tshirt.jpg" alt="T-Shirt Joconde">
    </div>
    <div class="product-info">
      <h2 class="product-title">T-Shirt Joconde</h2>
      <p class="product-description">Un T-Shirt incontournable.</p>
      <p class="product-price">29.99€</p>
    </div>
  <?php } elseif ($productID == 2) { ?>
    <div class="product">
      <img src="Images/tableaucène.jpg" alt="Tableau Cène">
    </div>
    <div class="product-info">
      <h2 class="product-title">Tableau Cène</h2>
      <p class="product-description">Un tableau représentant une célèbre peinture du musée, la Cène.</p>
      <p class="product-price">19.99€</p>
    </div>
  <?php } elseif ($productID == 3) { ?>
    <div class="product">
      <img src="Images/mug.jpg" alt="Mug David">
    </div>
    <div class="product-info">
      <h2 class="product-title">Mug David</h2>
      <p class="product-description">Un mug représentant la célèbre sculpture de Michel-Ange, David.</p>
      <p class="product-price">14.99€</p>
    </div>
  <?php } else {
    echo 'Produit non trouvé.';
  } ?>

  <form action="traitement.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>
    <br>
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required>
    <br>
    <label for="adresse">Adresse :</label>
    <input type="text" name="adresse" id="adresse" required>
    <br>
    <input type="submit" value="Valider">
  </form>
</div>

<?php require_once('_nav.php'); ?>