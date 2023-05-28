<?php require_once('functions.php');
require_once ('_nav.php'); ?>
<link rel="stylesheet" href="styles/avatar.css" />

<!DOCTYPE html>
<html>
<head>
    <title>Ma page PHP</title>

</head>
<body>
    <div>
        <?php
       
        $images = array(
            'avatar/avatar1.png',
            'avatar/avatar2.png',
            'avatar/avatar3.png',
            'avatar/avatar4.png',
            'avatar/avatar5.png',
          
        );
        $images2 = array(
            'avatar/avatar6.png',
            'avatar/avatar7.png',
            'avatar/avatar8.png',
            'avatar/avatar9.png',
            'avatar/avatar10.png',
          
        );
        
        foreach ($images as $index => $image) {
            echo '<a href="selection.php?avatar=' . $index . '"><div class="avatar"><img src="' . $image . '" alt="Avatar"></div></a>';
        } ?> <br>
        <?php
        foreach ($images2 as $index => $image) {
            echo '<a href="selection.php?avatar=' . ($index + count($images)) . '"><div class="avatar"><img src="' . $image . '" alt="Avatar"></div></a>';
        }
        ?>
    </div>
</body>
</html>
