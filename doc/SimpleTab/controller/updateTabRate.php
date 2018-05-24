<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 22.05.2018
 * projet: SimpleTab
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les informations des tablatures au format XML
 */



require_once "../model/tablatureManager.php";

// Je récupère l'id de la tablature
$idTab = -1;


if (isset($_POST['idTab']))
{
    $idTab = $_POST['idTab'];
}

if ($idTab != -1){

    $success = tablatureManager::getInstance()->updateTabRate($idTab);

    $jsn = json_encode($tabs);
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

?>