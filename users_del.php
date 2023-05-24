<?php
require_once('functions.php');

if (isset($_GET['id'])) {
    $userid = $_GET['id'];
    $bdd = connect();
    $sql = "DELETE FROM users WHERE id = :id;";
    
    $sth = $bdd->prepare($sql);
    
    $sth->execute([
        'id' => $userd
    ]);

    header('Location: admin_gerer.php?msg=Utilisateur bien supprimé !');
    exit();
} else {
    header('Location: admin_gerer.php');
    exit();
}
?>
