<?php
require_once('functions.php');

$bdd = connect();

$sql = "SELECT * FROM users";
$sth = $bdd->prepare($sql);
$sth->execute();
$users = $sth->fetchAll();



if (isset($_GET['approuves']) && $_GET['approuves'] == 'true' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
     
    $sql = "UPDATE users SET approuve = 1 WHERE id = :user_id";
    $sth = $bdd->prepare($sql);
    $sth->execute(['user_id' => $user_id]);

    
    header('Location: admin_gerer.php?msg=Utilisateur approuvé avec succès');
    exit();
} 


if (isset($_GET['approuves']) && $_GET['approuves'] == 'false' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "DELETE FROM users WHERE id = :user_id";
    $sth = $bdd->prepare($sql);
    $sth->execute(['user_id' => $user_id]);


    header('Location: admin_gerer.php?msg=Utilisateur supprimé avec succès');
    exit();
}
?>

<?php require_once('_nav.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/nav.css"> 
    <link rel="stylesheet" href="styles/admin.css"> 
    <title>Document</title>
    
</head>
<body>
<div class="container_custom">
<br><br>
<h1 class="titre_custom">Liste des utilisateurs</h1>

<?php if (isset($_GET['msg'])) { ?>
    <div class="message"><?php echo $_GET['msg']; ?></div>
<?php } ?>

<table class="table">
    <thead>
        <tr>
            <th width="2%">ID</th>
            <th>Email</th>
            <th style="padding-right: 30px" width="30%">Created_at</th>
            <th>État</th>
            <th>Action</th>
            <th>MDP</th>
            <th>Note</th>
                
               
           
        </tr>
    </thead>
    <style>
        body {
            background-image: url('img/gant.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
    </style>
    <tbody>
        <?php foreach ($users as $user) {
             if ($user['id'] == 1) {
                continue; 
            } ?>
            <tr>
                <td style="font-weight: 900;"><?php echo $user['id']; ?></td>
                <td style="padding-left: 60px; font-weight: 900;font-size: 20px;"><?php echo $user['email']; ?></td>
                <td style="padding-left: 50px; font-weight: 900; font-size: 20px;"> <?php echo date('d/m/Y H:i:s', strtotime($user['created_at'])); ?></td>
              

                <td>
                    <?php if ($user['approuve'] == 0) { ?>
                        <a href="admin_gerer.php?approuves=true&user_id=<?php echo $user['id']; ?>">Valider</a> |
                        <a href="admin_gerer.php?approuves=false&user_id=<?php echo $user['id']; ?>">Refuser</a>
                        <?php } else { ?>
                      <span style="color: green; font-weight: 900;">Validé</span>
                     <?php } ?>
                </td>
                
                <td>
                <?php if ($user['approuve'] == 1) { ?>
              <a href="users_del.php?id=<?php echo $user['id']; ?>" onClick="return confirm('Êtes-vous sûr ?');">Radier</a>
             <?php } ?>
             </td>
             
                <td>
                <?php if ($user['approuve'] == 1) { ?>
                <a href="reinitialiser.php?id=<?php echo $user['id']; ?>">Réinitialiser</a>
             <?php } ?>
             </td>
            <td>
            <?php if ($user['note'] == 1) {?>
                <a href="commentaire.php?id=<?php echo $user['id']; ?>">Lire Commentaire</a>
                <?php }  ?>
            </td>

            </tr>
        <?php } ?>
    </tbody>
</table>
<a class="" href="admin_vente.php">Gérer les ventes</a>
</div>
 
</body>
</html>

