<?php require_once('functions.php'); ?>
<?php require_once('_header.php'); ?>
    <?php require_once('_nav.php'); ?>
<h1>gg</h1>
<H2>Catégories: </H2>
<footer>
    <address>
        <ul>
            <li>Adresse : 123 Rue du Contact</li>
            <li>Téléphone : 01 234 567 89</li>
            <li>E-mail : contact@example.com</li>
        </ul>
    </address>
    <form action="" method="POST">
    <label for="commentaire">Commentaire :</label>
    <textarea id="commentaire" name="commentaire" rows="4" cols="50"></textarea>

    <label for="note">Note :</label>
    <select id="note" name="note">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>

    <input type="submit" value="Soumettre">
</form>

</footer>
</body>
</html>