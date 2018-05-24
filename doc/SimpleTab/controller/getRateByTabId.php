<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 23.05.2018
 * projet: SimpleTab
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les informations des notes par l'id d'une tablature
 */




require_once "../model/rateManager.php";

// Je récupère l'id de la tablature
$idTab = -1;


if (isset($_POST['idTab']))
{
    $idTab = $_POST['idTab'];
}

if ($idTab != -1) {

    $rate = rateManager::getInstance()->getRateByTabId($idTab);
}
if ($rate === false){
    echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
    exit();
}

$jsn = json_encode($rate);
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