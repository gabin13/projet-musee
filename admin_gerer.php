<?php
require_once('functions.php');

$bdd = connect();

$sql = "SELECT * FROM users";
$sth = $bdd->prepare($sql);
$sth->execute();
$users = $sth->fetchAll();


if (isset($_GET['approve']) && $_GET['approve'] == 'true' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "UPDATE users SET approuve = 1 WHERE id = :user_id";
    $sth = $bdd->prepare($sql);
    $sth->execute(['user_id' => $user_id]);

    
    header('Location: admin_gerer.php?msg=Utilisateur approuvé avec succès');
    exit();
}


if (isset($_GET['approve']) && $_GET['approve'] == 'false' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "DELETE FROM users WHERE id = :user_id";
    $sth = $bdd->prepare($sql);
    $sth->execute(['user_id' => $user_id]);


    header('Location: admin_gerer.php?msg=Utilisateur supprimé avec succès');
    exit();
}
?>

<?php require_once('_header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/admin.css"> 
</head>
<body>
<div class="container_custom">

<h1 class="titre_custom">Liste des utilisateurs</h1>

<?php if (isset($_GET['msg'])) { ?>
    <div class="message"><?php echo $_GET['msg']; ?></div>
<?php } ?>

<table class="table">
    <thead>
        <tr>
            <th width="2%">ID</th>
            <th>Email</th>
            <th style="padding-right: 95px" width="30%">Created_at</th>
            <th>Action</th>
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
        <?php foreach ($users as $user) { ?>
            <tr>
                <td style="color: orange; font-weight: 900;"><?php echo $user['id']; ?></td>
                <td style="color: orange; padding-left: 300px; font-weight: 900;font-size: 20px;"><?php echo $user['email']; ?></td>
                <td style="color: orange; padding-left: 200px; font-weight: 900;font-size: 20px;"><?php echo $user['created_at']; ?></td>
                <td>
                    <?php if ($user['approuve'] == 0) { ?>
                        <a href="admin_gerer.php?approve=true&user_id=<?php echo $user['id']; ?>">Approuver</a> |
                        <a href="admin_gerer.php?approve=false&user_id=<?php echo $user['id']; ?>">Refuser</a>
                    <?php } else { ?>
                        Approuvé
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</body>
</html>

