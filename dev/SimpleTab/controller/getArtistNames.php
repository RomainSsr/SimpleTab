<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 22.05.2018
 * Time: 14:06
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère tous les noms des artistes
 */


require_once '../Model/artistManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');


$artist = artistManager::getInstance()->getArtist();
if ($artist === false){
    echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
    exit();
}

$jsn = json_encode($artist);
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