<?php

$errors = [];
$allowedMimeTypes = ['text/plain', 'image/jpeg', 'image/jpeg'];

// Pour éviter de tester deux fois si le répertoire existe, je sors la vérification de la boucle !
if (!is_dir('uploads')) {
    mkdir('uploads', '0755');
}

// On boucle sur tous les fichiers proposés dans $_FILES.
foreach($_FILES as $file) {
    // On teste si on a spécifié un fichier et on regarde s'il n'y a pas d'erreur.
    if($file['error'] === 0) {
        if (in_array($file['type'], $allowedMimeTypes) && (int)$file['size'] <= (2 * 1024 * 1024)) {
            // On déplace le fichier
            move_uploaded_file($file["tmp_name"], 'uploads/' . getRandomName($file["name"]));
        }
        else {
            // On aurait aussi pu rediriger vers le formulaire avec un message d'erreur.
            $errors[] = "Vous avez fourni un mauvais type de fichier ou le fichier est trop gros pour: " . $file["name"];
        }
    }
    else {
        // On aurait pu rediriger vers le formulaire avec un message d'erreur aussi.
        $errors[] = "Une erreur s'est produite en uplodant le fichier";
    }
}

if(count($errors) > 0) {
    // base64_encode vous retourne une chaine da caractères encodée en base 64, sans espaces ( l'espace est aussi encodé )
    header('Location: index.php?e=' . base64_encode(json_encode($errors)));
}
else {
    header('Location: index.php?success');
}


/**
 * Create a random string for the files names.
 * @param String $regularName
 * @return string
 */
function getRandomName(String $regularName): string
{
    // écupération de l'extention du fichier.
    $infos = pathinfo($regularName);
    try {
        // Génère un string aléatoire d'une taille de 20
        $bytes = random_bytes(15);
    }
    catch (Exception $e) {
        // Est utilisé en cas d'échec de génération par random_bytes ( ce qui est peu probable )
        $bytes = openssl_random_pseudo_bytes(15);
    }
    // Converti des données binaires en représentation hexadécimale.
    return bin2hex($bytes) . '.' . $infos['extension'];
}

