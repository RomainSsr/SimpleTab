<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 23.05.2018
 * Time: 08:00
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les informations des notes par l'id d'un utilisateur
 * */




require_once "../model/rateManager.php";

// Je récupère l'id de l'utilisateur
$idUser = -1;


if (isset($_POST['idUser']))
{
    $idUser = $_POST['idUser'];
}

if ($idUser != -1) {

    $rate = rateManager::getInstance()->getRateByUserId($idUser);
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