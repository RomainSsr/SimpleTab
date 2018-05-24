<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 24.05.2018
 * projet: SimpleTab
 * description : récupère un utilisateur depuis son email
 */

require_once '../model/userManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère l'id de l'utilisateur
$email = "";


if (isset($_POST['email']))
{
    $email = $_POST['email'];
}

if ($email != ""){
    $user = userManager::getInstance()->getUserByEmail($email);
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