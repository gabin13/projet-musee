<?php
require_once('functions.php');


if ($_POST['email'] === 'admin@admin' && $_POST['password'] === 'admin') {
    header('Location: login.php');
    exit();
}

$bdd = connect();


$sql = "SELECT * FROM boutique";
$sth = $bdd->prepare($sql);
$sth->execute();
$oeuvres = $sth->fetchAll();

// Traitement des actions
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if ($action === 'ajouter') {
        // Ajouter une nouvelle œuvre
        $titre = $_POST['titre'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];

        $sql = "INSERT INTO oeuvres (titre, prix, stock, categorie) VALUES (:titre, :prix, :stock, 'tableaux')";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'titre' => $titre,
            'prix' => $prix,
            'stock' => $stock
        ]);

        $msg = "Nouvelle œuvre ajoutée avec succès.";
    } elseif ($action === 'supprimer') {
        // Supprimer une œuvre obsolète (le stock doit être égal à 0)
        $oeuvreId = $_POST['oeuvre_id'];

        $sql = "DELETE FROM oeuvres WHERE id = :id AND stock = 0";
        $sth = $bdd->prepare($sql);
        $sth->execute(['id' => $oeuvreId]);

        if ($sth->rowCount() > 0) {
            $msg = "Œuvre supprimée avec succès.";
        } else {
            $msg = "Impossible de supprimer l'œuvre. Vérifiez le stock.";
        }
    } elseif ($action === 'modifier_prix') {
        // Modifier le prix d'une œuvre existante
        $oeuvreId = $_POST['oeuvre_id'];
        $nouveauPrix = $_POST['nouveau_prix'];

        $sql = "UPDATE oeuvres SET prix = :prix WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'prix' => $nouveauPrix,
            'id' => $oeuvreId
        ]);

        $msg = "Prix de l'œuvre modifié avec succès.";
    } elseif ($action === 'augmenter_stock') {
        // Augmenter le stock d'une œuvre en cas de livraison d'une commande
        $oeuvreId = $_POST['oeuvre_id'];
        $quantite = $_POST['quantite'];

        $sql = "UPDATE oeuvres SET stock = stock + :quantite WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'quantite' => $quantite,
            'id' => $oeuvreId
        ]);

        $msg = "Stock de l'œuvre augmenté avec succès.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Gestion : Œuvres</title>
</head>
<body>
    <h1>Gestion : Œuvres</h1>
    
    <?php if (isset($msg)) { ?>
        <div class="message"><?php echo $msg; ?></div>
    <?php } ?>
    

    <h2>Ajouter une nouvelle œuvre</h2>
    <form action="" method="post">
        <input type="hidden" name="action" value="ajouter">
        <div>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" required>
        </div>
        <div>
            <label for="prix">Prix :</label>
            <input type="number" name="prix" step="0.01" required>
        </div>
        <div>
            <label for="stock">Stock :</label>
            <input type="number" name="stock" required>
        </div>
        <div>
            <input type="submit" value="Ajouter">
        </div>
    </form>
    
   
    <h2>Liste des œuvres</h2>
    <?php if (count($oeuvres) > 0) { ?>
        <table>
            <tr>
                <th>Titre</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($oeuvres as $oeuvre) { ?>
                <tr>
                    <td><?php echo $oeuvre['titre']; ?></td>
                    <td><?php echo $oeuvre['prix']; ?></td>
                    <td><?php echo $oeuvre['stock']; ?></td>
                    <td>
                        <!-- Formulaire pour supprimer une œuvre -->
                        <form action="" method="post" style="display: inline;">
                            <input type="hidden" name="action" value="supprimer">
                            <input type="hidden" name="oeuvre_id" value="<?php echo $oeuvre['id']; ?>">
                            <input type="submit" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette œuvre ?')">
                        </form>
                        
                        <!-- Formulaire pour modifier le prix d'une œuvre -->
                        <form action="" method="post" style="display: inline;">
                            <input type="hidden" name="action" value="modifier_prix">
                            <input type="hidden" name="oeuvre_id" value="<?php echo $oeuvre['id']; ?>">
                            <input type="number" name="nouveau_prix" step="0.01" required>
                            <input type="submit" value="Modifier prix">
                        </form>
                        
                        <!-- Formulaire pour augmenter le stock d'une œuvre -->
                        <form action="" method="post" style="display: inline;">
                            <input type="hidden" name="action" value="augmenter_stock">
                            <input type="hidden" name="oeuvre_id" value="<?php echo $oeuvre['id']; ?>">
                            <input type="number" name="quantite" required>
                            <input type="submit" value="Augmenter stock">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Aucune œuvre trouvée.</p>
    <?php } ?>
</body>
</html>
