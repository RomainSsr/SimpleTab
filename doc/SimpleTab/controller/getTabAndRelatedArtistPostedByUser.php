<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 16.05.2018
 * projet: SimpleTab
 */


/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les tablatures ainsi que leur artiste posté par un utilisateur
 */

require_once '../model/tablatureManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

$userId="";

if(isset($_POST['idUser']))
{
    $userId = $_POST['idUser'];
}

if($userId!="")
{
    $tablature = TablatureManager::getInstance()->getTabAndRelatedArtistPostedByUser($userId);
}

if ($tablature === false){
    echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
    exit();
}

$jsn = json_encode($tablature);
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