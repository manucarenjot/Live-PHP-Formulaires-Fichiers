<?php

if(isset($_GET['success'])) { ?>
        <div class="success">Vos fichiers ont biebn été envoyés, merci !</div><?php
}
elseif(isset($_GET['e'])) {
    $messages = base64_decode($_GET['e']);
    $messages = json_decode($messages);
    foreach($messages as $message) { ?>
        <div class="error"><?=$message?></div><?php
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon super site !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="monCSS.css">
</head>
<body>
    <div class="container">

        <form action="file.php" method="post" enctype="multipart/form-data">

            <label for="id-fichier-utilisateur">Choisissez un fichier texte ou image ( .txt, png ou jpg )</label>
            <input type="file" name="fichierUtilisateur" id="id-fichier-utilisateur" accept=".jpg, .jpeg, .png, .txt">&nbsp;( Max: 2Mo )<br>

            <label for="id-fichier-avatar">Choisissez un fichier texte ou image ( .txt, png ou jpg )</label>
            <input type="file" name="fichierAvatar" id="id-fichier-avatar" accept=".jpg, .jpeg, .png, .txt">&nbsp;( Max: 2Mo )<br>

            <input type="submit" value="Envoyer">

        </form>

    </div>

    <script src="js/forms.js"></script>
</body>
</html>



