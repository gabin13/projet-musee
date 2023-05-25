<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<?php require_once('_nav.php'); ?>  
<head>
    <br><br><br>
  <title>Boutique du Musée</title>
 <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    header {
      background-color: #f2f2f2;
      padding: 20px;
      text-align: center;
    }
    
    h1 {
      color: #333333;
      margin: 0;
    }
    
    main {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 20px;
    }
    
    .product-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
      align-items: flex-start;
    }
    
    .product {
      position: relative;
      width: 300px;
      margin: 10px;
      padding: 20px;
      background-color: #f2f2f2;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }
    
    .product:hover {
      transform: scale(1.05);
    }
    
    .product img {
      width: 100%;
      height: auto;
      margin-bottom: 10px;
    }
    
    .product-title {
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    .product-description {
      color: #666666;
      margin-bottom: 10px;
    }
    
    .product-price {
      color: #333333;
      font-weight: bold;
    }
  </style>

</head>
<body>
  <header>
    <h1>Boutique du Musée</h1>
  </header>
  
  <main>
  <div class="product" onclick="redirectToAchat(1)">
      <img src="Images/tshirt.jpg" alt="tshirt">
      <div class="product-info">
        <h2 class="product-title">T-Shirt Joconde</h2>
        <p class="product-description">Un T-Shirt incontournable.</p>
        <p class="product-price">29.99€</p>
      </div>
    </div>
    
    <div class="product" onclick="redirectToAchat(2)">
      <img src="Images/tableaucène.jpg" alt="tableau">
      <div class="product-info">
        <h2 class="product-title">Tableau Cène</h2>
        <p class="product-description">Un tableau représentant une célèbre peinture du musée, la Cène.</p>
        <p class="product-price">19.99€</p>
      </div>
    </div>

    <div class="product" onclick="redirectToAchat(3)">
      <img src="Images/mug.jpg" alt="mug">
      <div class="product-info">
        <h2 class="product-title">Mug David</h2>
        <p class="product-description">Un mug représentant la célèbre sculpture de Michel-Ange, David.</p>
        <p class="product-price">14.99€</p>
      </div>
    </div>
    
    <!-- Ajoutez d'autres produits ici -->
    
  </main>

  
  <script>
function redirectToAchat(productID) {
    window.location.href = 'achat.php?id=' + productID;
}
</script>
</body>
</html>
