<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 24.05.2018
 * projet: SimpleTab
 * description : Récupère l'utilisateur par son pseudo
 */

require_once '../model/userManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère l'id de l'utilisateur
$pseudoUser = "";


if (isset($_POST['pseudo']))
{
    $pseudoUser = $_POST['pseudo'];
}

if ($pseudoUser != ""){
    $user = userManager::getInstance()->getUserByPseudo($pseudoUser);
    if ($user === false){
        return false; // le pseudo est libre
        exit();
    }

    $jsn = json_encode($user);
    // Problème d'encodage Json
    if ($jsn == FALSE){
        $code = json_last_error();
        echo '{ "ReturnCode": 3, "Message": "Un problème de d\'encodage json ('.$code.'"}';
        exit();
    }
    // Succès
    echo '{ "ReturnCode": 0, "Data": '.utf8_encode($jsn).'}';
    exit();

}

// Erreur
echo '{ "ReturnCode": 1, "Message": "Il manque les paramètres"}';

?>