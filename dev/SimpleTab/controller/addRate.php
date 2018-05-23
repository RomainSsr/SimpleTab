<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 22.05.2018
 * Time: 15:42
 */


/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Ajoute une note dans la base
 */

require_once '../model/rateManager.php';
require_once '../model/tablatureManager.php';


// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

$idUser = -1;
$idTab = -1;
$rateValue = -1;

if(isset($_POST['idUser']) && isset($_POST['idTab']) && isset($_POST['rate']))
{
    $idUser = $_POST['idUser'];
    $idTab = $_POST['idTab'];
    $rateValue = $_POST['rate'];
}

if($idUser !=-1 && $idTab != -1 && $rateValue !=-1)
{
    $rate = rateManager::getInstance()->addRate($rateValue,$idTab,$idUser);
    $avergageRate = rateManager::getInstance()->getAverageRateByTabId($idTab);
    $avergageRate =$avergageRate[0][0];
    $updateRateSuccess = tablatureManager::getInstance()->updateTabRate($avergageRate,$idTab);
}

if ($rate === false && $updateRateSuccess === false){
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