<?php require_once('functions.php'); ?>
<link rel="stylesheet" href="styles/achat.css">
<link rel="stylesheet" href="styles/footer.css">


<?php
$bdd = connect();

$sql = "SELECT * FROM boutique";
$sth = $bdd->prepare($sql);
$sth->execute();
$boutique = $sth->fetchAll();

?>
<br>

<div class="container">
  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($boutique) {
      foreach ($boutique as $produit) {
        $nom = $produit['nom'];
        $description = $produit['description'];
        $image = $produit['image'];
        $prix = $produit['prix'] . '€';
        $stock = $produit['stock'];

        if ($id == $produit['id']) {
          echo "<div class='produit-nom'>Produit : $nom</div>";
          echo "<div class='produit-description'>$description</div>";
          echo "<img class='produit-image' src='Images/$image'>";
          echo "<div class='produit-prix'>$prix</div>";
          echo "<form action='' method='post'>";

          echo "<label for='stock'>Nombre de produits :</label>";
          echo "<select name='stock' id='stock'>";
          for ($i = 1; $i <= $stock; $i++) {
            echo "<option value='$i'>$i</option>";
          }
          echo "</select>";
          echo "<input type='hidden' name='id' value='$id'>";
          echo "<br><br>";
          echo "<label for='nom'>Nom :</label>";
          echo "<input type='text' name='nom' id='nom' required>";
          echo "<br>";
          echo "<label for='prenom'>Prénom :</label>";
          echo "<input type='text' name='prenom' id='prenom' required>";
          echo "<br>";
          echo "<label for='adresse'>Adresse :</label>";
          echo "<input type='text' name='adresse' id='adresse' required>";
          echo "<br>";
          echo "<input type='submit' value='Valider' name='valider'>";
          echo "</form>";
        }
      }
    }
  } else {
    echo "L'identifiant du produit est manquant.";
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['valider'])) {
      if (isset($_POST['stock']) && isset($_POST['id'])) {
        $stock = $_POST['stock'];
        $id = $_POST['id'];

        $sql = "UPDATE boutique SET stock = stock - :stock WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute(array(':stock' => $stock, ':id' => $id));

        if ($sth->rowCount() > 0) {
          echo "Le stock a été mis à jour avec succès!";
          header('Location: traitement.php');

        } else {
          echo "Aucune ligne mise à jour. Vérifiez les valeurs de stock et d'ID.";
        }
      } else {
        echo "Les données de stock et d'ID sont manquantes.";
      }
    }
  }
  ?>
  <br>

  <div>Remplissez ce formulaire pour recevoir votre achat !</div>

</div>

<?php require_once('_nav.php'); ?>
<?php require_once('_footer.php'); ?>
