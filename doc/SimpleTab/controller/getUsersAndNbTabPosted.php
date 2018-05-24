<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 22.05.2018
 * projet: SimpleTab
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les utilisateurs et le nombre de tablatures qu'ils ont posté
 */

require_once '../model/userManager.php';


// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');


$user = userManager::getInstance()->getUsersAndNbTabPosted();
if ($user === false){
    echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
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


?>