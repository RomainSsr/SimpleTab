<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 22.05.2018
 * Time: 07:44
 */


/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Supprime la tablatures à partir d'un ID
 */

require_once '../Model/tablatureManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère l'id de la tablature
$idTab = -1;


if (isset($_POST['idTab']))
{
    $idTab = $_POST['idTab'];

}

if ($idTab != -1){
    $success = TablatureManager::getInstance()->deleteTab($idTab);
    if ($success === false){
        echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
        exit();
    }

    $jsn = json_encode($success);
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