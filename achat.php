<link rel="stylesheet" href="styles/achat.css">
<?php require_once('functions.php'); 

$bdd = connect();

$sql = "SELECT * FROM boutique ";
$sth = $bdd->prepare($sql);
$sth->execute();
$boutique = $sth->fetchAll();

?> 

<br><br><br>

<div class="container">
  <?php $productID = $_GET['id'];

 
if ($boutique) {
  foreach ($boutique as $produit) {
    $nom = $produit['nom'];
    $description = $produit['description'];
    $image = $produit['image'];
    $prix = $produit['prix'];

    $id = $produit['id'];

    if ($id == $_GET['id']) {
      echo "<div>Produit : $nom</div>";
    }
  }
}
?>

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
